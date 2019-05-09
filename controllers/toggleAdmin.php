<?php
//print_r($_GET);
//die();
$id = isset($_GET['id']) ? $_GET['id'] : null ;
if(empty($id)) {
    header('Location: ../index.php');
    exit();
}
// Se connecter à la DB
require "../kernel/db_connect.php";
// Récupérer le Model User pour mettre à jour le user dans la table > is_admin = 1
require '../models/user.php';
setAdmin($id);
// Stocker un message de confirmation dans la session
session_start();
$_SESSION['messages'] = "Le user est admin";
header('Location: ../backend/gestion.php');
// Redirection vers la page gestion.php avec affichage du message
