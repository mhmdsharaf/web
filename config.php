<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'task';
$port = 3306;

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


