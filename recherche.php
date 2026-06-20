<?php
$recherche = $_GET['recherche'] ?? '';
$etat = $_GET['etat'] ?? '';

if ($recherche !== '') {
    $sql = "SELECT * FROM annonces WHERE titre LIKE '%$recherche%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM annonces ORDER BY id DESC";
}

$sql = "SELECT * FROM annonces where etat"


$result = mysqli_query($conn, $sql);




?>