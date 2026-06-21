<?php
session_start();
require '../db.php';

// Il faut être connecté pour voir cette page
if(empty($_SESSION['user_id'])
    header('Location: connexion.php');
    exit;
}

$userId = $_SESSION['user_id'];
$successMessage= ' ';
$errors = [];

// la pour Récupérer les infos actuelles de l'utilisateur
$query ="SELECT id, nom, email FROM users WHERE id = ?";
$stmt=mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$nomInput=$userData["nom"]
$emailInput = $userData['email'];

//  la Si le formulaire est envoyé on va mettre a jour les informations en utilssant POST
if($-SERVER['REQUEST_METHOD']=== 'POST') {


    $nomInput = trim($_POST['nom'] ?? '');
    $emailInput = trim($_POST['mail'] ?? '');

    if(empty($nomInput) || empty($emailInput)) {
        $Errors[] = "Le nom et l'email sont obligatoires.";
    }

    if (!filter_var($nomInput, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse mail invalide.";
    }

    if (empty($errors)) {
        $updateQuery = "UPDATE users SET nom = ?, email = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt,"ssi",$nomInput, $emailInput,$userid);

      if(mysqli_stmt_execute($updateStmt));
      $_SESSION['username'] =$nomInput;
      $successMessage="Profil  mis à jour avec succès.";

        } else {
            $errors[] = "Une erreur est survenue.";
        }
        mysqli_stmt_close($updateStmt);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe4ec;">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e75480;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Invader</a>
            <a href="logout.php" class="btn btn-light">Se déconnecter</a>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <form method="post" class="bg-white p-5 rounded shadow" style="width: 450px;">

            <h2 class="text-center mb-4">Mon profil</h2>

            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($nomInput) ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">E-mail</label>
                <input type="email" name="mail" class="form-control" value="<?= htmlspecialchars($emailInput) ?>" required>
            </div>

            <button type="submit" class="btn w-100" style="background-color: #e75480; color: white;">Enregistrer</button>

        </form>
    </div>

</body>
</html>
