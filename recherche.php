<?php
$recherche = $_GET['recherche'] ?? '';

if ($recherche !== '') {
    $sql = "SELECT * FROM annonces WHERE titre LIKE '%$recherche%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM annonces ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>