<?php
$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'dbuser';
$pdo = new PDO($dsn, $user);

session_start();