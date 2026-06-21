<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
   header('Location: ../Authentification/connexion.php');
    exit;
}
if (isset($_POST['publier'])) {
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $upload0k=move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $image);
    // maintenant pour tout enregistrer dans la base de donnée on utilise la requete mysql preparée 
    
    if(!$upload0k){
        die("Erreur lors de l'upload de l'image.");
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO annonces (titre, prix, etat, description, image, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sdsssi", $titre, $prix, $etat, $description, $image, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
 
    header('Location: mes-annonces.php');
    exit;

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style-annonces.css">
</head>
<style>
body {
    background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
}
h2 {
    color: #993556;
}
.container {
    background-color: pink;
    border-radius: 16px;
    padding: 30px;
}
label {
    color: #993556;
    font-weight: bold;
}
.form-control {
    border: 1px solid #D4537E;
    border-radius: 10px;
}

.form-control:focus {
    border-color: #993556;
    outline: none;
    box-shadow: none;
}

</style>
<body>
    <div class="container mt-4" style="max-width: 600px;">
         <h2>Publier une annonce</h2>
         <form action="" method="POST" enctype="multipart/form-data">
     <div class="mb-3">
         <label for="titre">titre</label>
         <input placeholder="titre.." type="text" name="titre" class="form-control">
     </div>
     <div class="mb-3">
         <label for="prix">prix</label>
         <input placeholder="prix.." type="number" name="prix" class="form-control" min="0" step="0.01">
     </div>
    <div class="mb-3">
    <label for="etat">etat</label>
     <select name="etat" id="" class="form-control" required>
         <option value="" disabled selected> Choisir un etat </option>
         <option value="neuf">neuf</option>
         <option value="bon_etat">bon_etat</option>
         <option value="correct">correct</option>
      </select>
     </div>
   <div class="mb-3">
      <label for="description">descripion</label>
     <textarea name="description" id="descripion" class="form-control"></textarea>
</div>
<div class="mb-3">
    <label for="image">Image</label>
    <input type="file" name="image" accept="image/*" class="form-control" accept="image/*">
</div>
<button type="submit" name="publier"  class="btn btn-outline-light"> publier </button>
</form>
</div>
</body>
</html>