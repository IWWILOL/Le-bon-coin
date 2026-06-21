<?php

$recherche = $_GET['recherche'] ?? '';
$etat = $_GET['etat'] ?? '';
$prixMax = $_GET['prix'] ?? '';
$page = max(1, (int)($_GET['page'] ?? 1));
$parPage = 9;
$offset = ($page - 1) * $parPage;

$sql = "SELECT * FROM annonces WHERE 1=1";

if ($recherche !== '') {
    $sql .= " AND titre LIKE '%$recherche%'";
}
if ($etat !== '') {
    $sql .= " AND etat = '$etat'";
}
if ($prixMax !== '') {
    $sql .= " AND prix <= '$prixMax'";
}

$sql .= " ORDER BY id DESC LIMIT $parPage OFFSET $offset";

$result = mysqli_query($conn, $sql);

?>