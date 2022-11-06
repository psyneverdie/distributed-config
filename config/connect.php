<?php


$server = "localhost";
$user = "root";
$password = "root";
$dbname = "sberapi";

try {
    $connect = new PDO ("mysql:host=$server; dbname=$dbname; charset=utf8;", $user, $password);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}