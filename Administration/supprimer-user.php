php<?php
require "../db.php";

$id = $_POST['id'] ?? 0;

mysqli_query($conn, "DELETE FROM users WHERE id = $id");

header('Location: administration.php');
exit;
?>