<?php
//informations de connexion 
$host= "localhost";
$user= "root";
$pass= "";
$dbname="leboncoin";
$conn = mysqli_connect($host, $user, $pass, $dbname);
if ($conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
?>