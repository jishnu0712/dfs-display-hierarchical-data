<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "jishnu";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
