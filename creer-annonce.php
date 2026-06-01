<?php
session_start();
$_SESSION['user_id'] = 1;
require 'connexion.php';
if (isset($_POST['publier'])) {
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $etat = $_POST['etat'];
    $description = $_POST['description'];
 /*"Quand l'utilisatrice choisit une photo et clique sur Publier, PHP récupère la photo avec $_FILES qui contient deux infos importantes :
 ['name'] → le nom du fichier, par exemple echarpe.jpg — on le sauvegarde dans la variable $image pour l'enregistrer dans la BDD
 ['tmp_name'] → PHP met d'abord la photo dans un dossier temporaire automatiquement. move_uploaded_file la déplace depuis ce dossier temporaire vers mon dossier uploads/
 Donc après ça, la photo est dans uploads/echarpe.jpg et dans la BDD j'ai juste le nom echarpe.jpg" */
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . 'uploads/' . $image);
    // maintenant pour tout enregistrer dans la base de donnée on utilise la requete mysql preparée 
    $stmt = $pdo->prepare("INSERT INTO annonces (titre, prix, etat, description, image, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$titre, $prix, $etat, $description, $image, $_SESSION['user_id']]);
    header('Location: mes-annonces.php');
    exit;
}
?>
<?php require 'header.php'; ?>

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
      <option value="etat">etat</option>
      <option value="neuf">neuf</option>
      <option value="bon etat">bon etat</option>
      <option value="correct">correct</option>
   </select>
</div>
<div class="mb-3">
    <label for="description">descripion</label>
    <textarea name="description" id="descripion" class="form-control"></textarea>
</div>
<div class="mb-3">
    <label for="image">image</label>
    <input type="file" name="image" accept="image/*">
</div>
<button type="submit" name="publier" class="btn btn-primary"> publier </button>
</form>

<?php require 'footer.php'; ?>
