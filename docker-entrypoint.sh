#!/bin/bash
set -e

echo "🌸 Melati V2 — Starting deployment..."

# ============================================
# 1. Setup SQLite database on persistent volume
# ============================================
if [ -n "$RAILWAY_VOLUME_MOUNT_PATH" ]; then
    DB_PATH="${RAILWAY_VOLUME_MOUNT_PATH}/database.sqlite"
    echo "📁 Using persistent volume: $DB_PATH"

    if [ ! -f "$DB_PATH" ]; then
        echo "🆕 Creating new SQLite database..."
        touch "$DB_PATH"
    fi

    export DB_DATABASE="$DB_PATH"
else
    # Fallback: use default path inside container
    DB_PATH="/app/database/database.sqlite"
    echo "⚠️  No persistent volume detected, using: $DB_PATH"

    if [ ! -f "$DB_PATH" ]; then
        touch "$DB_PATH"
    fi

    export DB_DATABASE="$DB_PATH"
fi

# ============================================
# 2. Generate APP_KEY if not already set
# ============================================
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# ============================================
# 3. Run database migrations
# ============================================
echo "🗄️  Running migrations..."
php artisan migrate --force

# ============================================
# 4. Seed database (only on first deploy)
# ============================================
SEED_FLAG="${RAILWAY_VOLUME_MOUNT_PATH:-.}/.seeded"
if [ ! -f "$SEED_FLAG" ]; then
    echo "🌱 Seeding database with demo data..."
    php artisan db:seed --force
    touch "$SEED_FLAG"
    echo "✅ Database seeded successfully!"
else
    echo "⏭️  Database already seeded, skipping..."
fi

# ============================================
# 5. Laravel optimizations for production
# ============================================
echo "⚡ Optimizing for production..."
php artisan route:cache
php artisan view:cache

# ============================================
# 6. Start Laravel server
# ============================================
PORT="${PORT:-8080}"
echo "🚀 Starting Melati V2 on port $PORT..."
exec php artisan serve --host=0.0.0.0 --port="$PORT"
