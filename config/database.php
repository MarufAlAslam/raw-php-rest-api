<?php
$host = 'localhost';
$dbname = 'swaap';
$username = 'root';  // Change this if you use a different username
$password = '';      // Change this if you use a different password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => "Database connection failed", "message" => $e->getMessage()]));
}
?>
