FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite bcmath \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 20 (for Vite + Tailwind CSS build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first (Docker layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package files and build frontend assets
COPY package.json package-lock.json ./
RUN npm ci

# Copy entire project
COPY . .

# Build Vite assets (Tailwind CSS 4 + Alpine.js)
RUN npm run build

# Run Laravel post-install scripts
RUN composer run-script post-autoload-dump 2>/dev/null || true

# Create required Laravel directories
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy entrypoint script
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["/docker-entrypoint.sh"]
