<?php
session_start();
define("APP_ROOT", __DIR__);
$host = 'localhost';
$db = 'ecotrack';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false,
];
define('__DB__', new PDO($dsn, $user, $pass, $opt));

function query($query, $data){
    $stmt = __DB__->prepare($query);
    $stmt->execute($data);
    return $stmt;
}