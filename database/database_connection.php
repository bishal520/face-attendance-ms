<?php
$host = "localhost";
$port = "3307";  // Use the correct port number
$database = "attendance-db";
$user = "root";
$password = "";

try {
    // Update the PDO connection string to include the port
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
