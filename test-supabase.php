<?php
// Simple test without Laravel
$host = 'aws-1-us-east-2.pooler.supabase.com ';
$port = 5432;
$dbname = 'postgres';
$user = 'postgres.caoxgptfcygumjbzofun';
$password = 'gauOMeh2byjiqAbz';

echo "Testing Supabase pooled connection...\n";
echo "Host: $host\n";
echo "User: $user\n\n";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false
    ]);
    
    echo "SUCCESS: Connected to database!\n";
    
    // Test query
    $stmt = $pdo->query("SELECT 1 as test, current_database() as db");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "Database: " . $result['db'] . "\n";
    echo "Test query: " . $result['test'] . "\n";
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Error code: " . $e->getCode() . "\n";
}