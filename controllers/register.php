<?php
// Etape 1 > connexion à la base de données
require '../kernel/db_connect.php';
// Etape 2 > récupérer les données du formulaire
require '../kernel/functions.php';
require '../models/user.php';


$fields_required = ['login','password','email','nom','prenom'];
$datas_form = extractDatasForm($_POST,$fields_required);
//var_dump($datas_form);
// Etape 3 > Vérifier que tous les champs sont remplis
$messages = [];
if(in_array(null,$datas_form)) {
    $messages[] = "Tous les champs sont obligatoires";
}
// Etape 4-a > Vérifier le format de l'email
if(filter_var($datas_form['email'],FILTER_VALIDATE_EMAIL) == false) {
    $messages[] = "Votre email est invalide";
}
// Etape 4 > Vérifier que l' email est unique (pas déjà dans la DB)
$resultat = findOneUserBy('email',$datas_form['email']);
//echo count($resultat);
$nb_emails = count($resultat);
if($nb_emails >0) {
    $messages[] = "Un user est déjà inscrit avec cet email. Peut-être, avez-vous déjà un compte ?";
}

// Fixtures
// Etape 5 > Vérifier que le login est unique (pas déjà dans la DB)
$res_login = findOneUserBy('login',$datas_form['login']);
$nb_logins = count($res_login);
if($nb_logins>0) {
    $messages[] = "Ce login est déjà pris.";
}
// Etape 6 > Vérifier que le mot de passe fait au moins 8 caractères
if(strlen($datas_form["password"]) < 8) {
    $messages[] = "Ce mot de passe est trop court";
}
// Etape 7 > Si tout est ok
// > insertion des datas dans la DB
// > redirection vers page confirmation inscription
if(count($messages) == 0) {
    // Exécuter une requête SQL pour transferer les données saisies dans le form dans la base de données.
        addUser($datas_form);

    // Démarrage de session
    session_start();
    // On stocke dans la session une données "preuve"
    $_SESSION['is_inscrit'] = true;
    header('Location: ../confirmation.php');
    exit();
}

// Général > Gestion des erreurs: Quand un/ou n problème(s) se déclenche(nt), il faut afficher tous les messages d'erreurs en même temps sur la page d'inscription.

// démarrage session pour stocker les messages d'erreur
session_start();
$_SESSION['messages'] = $messages;
header('Location: ../index.php');