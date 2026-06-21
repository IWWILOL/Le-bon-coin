<?php
session_start();

// Vider la session 
$_SESSION = [];
session_destroy();
header('location: connexion.php');
exit;


