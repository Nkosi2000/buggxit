<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$db = getenv('DB_DATABASE');

echo "Testing connection to: $host\n";
echo "Username: $user\n";
echo "Database: $db\n";

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass);
    echo "✅ Connection successful!\n";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}
