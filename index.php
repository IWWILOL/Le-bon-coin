<?php
require 'db.php';
require 'recherche.php';

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
        
            <div class="item"><img  src="images/cadre.png" alt="cadre" draggable="false"></div>
            <div class="item"><img  src="images/Logo.png" alt="logo" draggable="false"></div>
            <div class="item"><img  src="images/homeplushy.jpg" alt="Plushie" draggable="false"></div>
            
            <div class="item">
                <nav>
                  <a href="navrecherche.html">Favoris</a>
                  <a href="navrecherche.html">Mes Recherches</a>
                  <a href="../config/register.php">Connexion</a>
                </nav>
               
                
                
                
              

            </div>
          
        </header>
        
        <nav>
          <form action="index.php" method="POST">
            <input type="text" id="Rechercher" name="Rechercher" placeholder="Rechercher" required>
            <br>
            <label for="neuf"> neuf :</label>
            <input type="radio" id="neuf" name="etat" placeholder="neuf">
            <label for="bonetat"> bon etat :</label>
            <input type="radio" id="bonetat" name="etat" placeholder="bonetat">
            <label for="correct"> correct :</label>
            <input type="radio" id="correct" name="etat" placeholder="correct">
            <br>
            <label for="Prix"> Prix :</label>
            <input type="text" id="prix"  name="prix" placeholder="prix">
            <br>
            <button type="submit"> Rechercher </button>


          </form>  
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
