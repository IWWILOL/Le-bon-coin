<?php
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
                  <a href="Annonces/mes-annonces.php">voir mes annonces</a>
                  <a href="Annonces/creer-annonce.php">Publier une annonce</a>
                  <a href="navrecherche.html">Favoris</a>
                  <a href="navrecherche.html">Mes Favoris</a>
                  <a href="Authentification/connexion.php">Connexion</a>
                </nav>
               
                
                
                
              

            </div>
          
        </header>
        
        <div class="layout">
          <nav class="nav">
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
          </nav>

          <main class="main">

            <div class="grille-annonces">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <div class="card" style="width: 18rem;">
                  <img src="<?= $row['image'] ?>" class="imgcard" alt="<?= $row['titre'] ?>">
                  <div class="card-body">
                      <h5 class="titlecard"><?= $row['titre'] ?></h5>
                      <p class="textcard"><?= $row['etat'] ?></p>
                      <a href="Annonces/annonce.php?id=<?= $row['id'] ?>" class="prixcard"><?= $row['prix'] ?> €</a>
              </div>
              </div>
            <?php endwhile; ?>
            </div>

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
