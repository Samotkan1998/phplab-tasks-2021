<?php
$config = require_once './config.example.php';

$pdo = new \PDO(
    sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['dbname']),
    $config['user'],
    $config['pass'],
);
