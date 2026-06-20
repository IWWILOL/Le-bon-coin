<?php
session_start();
require'config/db.php';
$error = "";
//verifier si l’utilisateur a envoyé le code
if($_SERVER['REQUEST_METHOD'])=== 'POST'
//recupérer ce que l’utilisateur a tapé
$nom     = trim($_POST['nom'] ?? '');
$email   = trim($_POST['email'] ?? '');
$mdp     = $_POST['password'] ?? '';
$confirm = $_POST['confirm'] ?? '';
//verifier les données
if (!$nom || !$email || !$mdp) {
    $error = "Tous les champs sont obligatoires.";
} elseif ($mdp !== $confirm) {
    $error = "Les mots de passe ne correspondent pas.";
}
