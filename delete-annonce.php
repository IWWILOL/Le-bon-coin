<?php



session_start();

echo var_dump($_GET);


if (!isset($_SESSION["user"])) {
    header("Location: creer-annonce.php");
    exit;
}


if($_SESSION["user"]["access"] < 1) {
    header("Location: creer-annonce.php");
    exit;
}

$id = $_GET["id"];


$sql = "DELETE FROM users WHERE id = $id";
$db_connect =  mysqli_connect("localhost", "root", "", "invader_bar");  
mysqli_query($db_connect, $sql);
header("Location: tableau.php");