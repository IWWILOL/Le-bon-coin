<?php
mysqli_report(MYSQLI_REPORT_OFF);
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cloud_diva";
$conn = @mysqli_connect($host, $user, $pass, $dbname, 3306);
if (!$conn) {
    $conn = @mysqli_connect($host, $user, $pass, $dbname, 3308);
}
if (!$conn) {
    die("Erreur de connexion :" . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
?>