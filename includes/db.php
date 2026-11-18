<?php
// includes/db.php
$host = 'localhost'; 
$dbname = 'your_database_name';
$username = 'your_database_username';
$password = 'your_database_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set PDO to throw exceptions on error and fetch associative arrays by default
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // If it fails, it gracefully stops the page from loading broken grids
    error_log("Database Connection Failed: " . $e->getMessage());
    die("A system error occurred. Please try again later.");
}
?>