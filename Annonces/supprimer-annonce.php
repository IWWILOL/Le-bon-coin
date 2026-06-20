<?php

$conn = @mysqli_connect("localhost", "root", "", "cloud_diva", 3306);

if (!$conn) {
    $conn = @mysqli_connect("localhost", "root", "", "cloud_diva", 3308);
}

session_start();
$_SESSION['user_id'] = 1;
require 'connexion.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM annonces WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header('Location: mes-annonces.php');
exit;
test
?>