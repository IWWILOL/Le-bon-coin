<?php
session_start();

// Vider la session 
$_SESSION = [];
session_destroy();
header('location: ../index.php');
exit;


