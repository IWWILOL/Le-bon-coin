<?php
session_start();
//Vider la session 

$_SESSION = [];
session_destroy();

hearder('Location: login.php');
exist;
