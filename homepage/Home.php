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
$result = mysqli_query($conn, "SELECT * FROM annonces ORDER BY id DESC");

?>

<!DOCTYPE html>

<html lang="fr">

  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
  </head>

  <body class="cormorant">
     
        <header>
        
            <div class="item"><img  src="uploads/html/cadre.png" alt="cadre" draggable="false"></div>
            <div class="item"><img  src="uploads/html/Logo.png" alt="logo" draggable="false"></div>
            <div class="item"><img  src="uploads/html/homeplushy.jpg" alt="Plushie" draggable="false"></div>
            
            <div class="item">
                <nav>
                  <a href="navrecherche.html">Favoris</a>
                  <a href="navrecherche.html">Mes Recherches</a>
                  <a href="navconnexion.php">Connexion</a>
                </nav>
               
                
                
                
              

            </div>
          
        </header>
        
        <nav>
          <br>
          
          <H1>TEST</H1>
          testTEST
        </nav>
        <main>
        <div class="grille-annonces">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="annonce-card">
            <img src="<?= $row['image'] ?>" alt="<?= $row['titre'] ?>">
            <h3><?= $row['titre'] ?></h3>
            <p><?= $row['prix'] ?> €</p>
            <p><?= $row['etat'] ?></p>
          </div>
        <?php endwhile; ?>
        </div>
        </main>
        
        <footer>
          test
        </footer> 
      
  </body>
</html>
