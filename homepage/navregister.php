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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "INSERT INTO users (nom, email, password) VALUES ('$nom','$email','$password')";

    if(mysqli_query($conn,$sql)){
        echo "New user added!";
    } else {
        echo "Error: " .mysqli_error($conn);
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H1>Création de votre compte Cloud Divas</H1>

    <div>
        
        <form action="navregister.php" method= "post">
                <div>
                    <label for="prenom"> Prénom :</label>
                    <input type="text" id="prenom" name="prenom" placeholder="prenom" required>
                </div>
            <br>
                <div>
                    <label for="nom"> Nom :</label>
                    <input type="text" id="nom" name="nom" placeholder="nom" required> 
                </div>
            <br>
                <div>
                        <label for="Genre"> Genre :</label>
                    <br>
                
                        <label for="Homme"> Homme :</label>
                        <input type="radio" id="Homme" name="genre" value="homme" required>

                        <label for="Femme"> Femme :</label>
                        <input type="radio" id="Femme" name="genre" value="femme" required>

                        <label for="nongenre"> Non genré :</label>
                        <input type="radio" id="nongenre" name="genre" value="nongenre" required>
                </div>
            <br>
                <div>
                    <label for="age">Age :</label >
                    <input type="date" id="age" name="age" placeholder="jj/mm/anné" required>
                </div>
            <br>
                <div>
                    <label for="mail"> E-mail :</label>
                    <input type="mail" id="mail" name="email" placeholder="e-mail" required>
                </div>
            <br>
                <div>
                    <label for="password">  mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="password" required>
                </div>
            <br>
                <div>
                    <label for="conpassword"> Confirmation de mot de passe :</label>
                    <input type="password" id="conpassword" name="conpassword" placeholder="password" required>
                </div>
        
                
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <br>
    <h3>Si vous avez un Compte :</h3><a href="navconnexion.php"> se Connecter</a>
    
    
</body>
</html>