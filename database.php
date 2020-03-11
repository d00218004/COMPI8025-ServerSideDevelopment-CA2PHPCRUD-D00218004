<?php
    $dsn = 'mysql:host=localhost;dbname=D00218004';
    $username = 'D00218004';
    $password = 'QSTiiMOw';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>