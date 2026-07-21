<?php
echo "Connecting to non-pooled Neon endpoint...\n";
$dsn = "pgsql:host=ep-broad-morning-aidvtb8a.c-4.us-east-1.aws.neon.tech;port=5432;dbname=neondb;sslmode=require;options=endpoint=ep-broad-morning-aidvtb8a";
try {
    $pdo = new PDO($dsn, "neondb_owner", "npg_el3YSKuoQh0F", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5,
    ]);
    echo "SUCCESS connecting to non-pooled endpoint!\n";
} catch (Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}
