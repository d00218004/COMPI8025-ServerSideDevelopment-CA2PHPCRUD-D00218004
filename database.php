<?php
    $dsn = 'mysql:host=localhost;dbname=samsung-db';
    $username = 'manager';
    $password = 'Manager//01//';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>