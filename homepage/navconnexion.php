<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = @mysqli_connect("localhost", "root", "", "cloud_diva", 3306);

if (!$conn) {
    $conn = @mysqli_connect("localhost", "root", "", "cloud_diva", 3308);
}

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}

echo "connected to the database succesfully !";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style Connexion.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
            <div>
                <label for="email"> Email : </label>
                <input type="email" id="email" name="email" placeholder="email">
            </div>
            
        <br>
            <div>
                <label for="password"> Password : </label>
                <input type="password" id="password" name="password" placeholder="password">
            </div>
        <br>
            <div>
                <input type="submit">
            </div>
    </form>
    <h3>Si vous avez pas un Compte : </h3><a href="navregister.php"><h3>Crée un Compte</h3></a>
</body>
</html>