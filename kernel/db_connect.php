<?php
$dsn = "mysql:host=localhost;dbname=td_php_db";
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];

try {
    $db = new PDO($dsn,"root","",$options);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Problème de connexion à la DB".$e->getMessage();
}

$toto = "toto";

//var_dump($db);