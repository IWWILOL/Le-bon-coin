<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
   header('Location: ../Authentification/connexion.php');
    exit;
}
$sql="SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result=mysqli_query($conn,$sql);
$questions=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>