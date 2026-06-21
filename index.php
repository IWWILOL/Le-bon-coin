<?php
session_start();
require 'db.php';
require 'recherche.php';
?>

<!DOCTYPE html>

<html lang="fr">

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <nav>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="Annonces/mes-annonces.php">Mes annonces</a>
                    <a href="Annonces/creer-annonce.php">Créer annonce</a>
                    <a href="favoris/favoris.php">Favoris</a>
                    <a href="Authentification/Profil.php">Profil</a>
                    <a href="Authentification/logout.php">Déconnexion</a>
                    <?php else: ?>
                    <a href="Authentification/connexion.php">Connexion</a>
                    <a href="Authentification/register.php">Inscription</a>
                    <?php endif; ?>
                </nav>

                   
                   
                </nav>
               
                
  
            </div>
          
        </header>
        
        <div class="layout">
          <nav class="nav">
              <img src="images/Vectorup.png" class="deco-top-right" alt="">
              <form action="index.php" method="GET">
                <input type="text" id="recherche" name="recherche" placeholder="Rechercher">
                <br>
                <label for="neuf"> neuf :</label>
                <input type="radio" id="neuf" name="etat" value="neuf">
                <label for="bonetat"> bon etat :</label>
                <input type="radio" id="bonetat" name="etat" value="bon etat">
                <label for="correct"> correct :</label>
                <input type="radio" id="correct" name="etat" value="correct">
                <br>
                <label for="Prix"> Prix :</label>
                <input type="text" id="prix" name="prix" placeholder="prix">
                <br>
                <button type="submit"> Rechercher </button>
              </form> 
              <img src="images/Vectordown.png" class="deco-bottom-left" alt=""> 
          </nav>

          <main class="main">
            <table class="grille-annonces">
                        <?php 
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)): 
                if ($count % 3 == 0) echo "<tr>";
            ?>
                <td>
                    <div class="card">
                        <img src="Annonces/uploads/<?= $row['image'] ?>" class="imgcard" alt="<?= $row['titre'] ?>">
                        <div class="card-body">
                            <h5 class="titlecard"><?= $row['titre'] ?></h5>
                            <p class="textcard"><?= $row['etat'] ?></p>
                            <a href="Annonces/annonce.php?id=<?= $row['id'] ?>" class="prixcard"><?= $row['prix'] ?> €</a>
                        </div>
                    </div>
                </td>
            <?php 
                $count++;
                if ($count % 3 == 0) echo "</tr>";
            endwhile; 
            if ($count % 3 != 0) echo "</tr>";
            ?>
            </table>

          <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>
          </ul>
        </main>

        </div>
        <footer>
          <div>
            <a href="Administration/Administration.php"> Pouvoir Administrateur</a>
          </div>
        </footer> 
      
  </body>
</html>
