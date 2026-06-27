<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Authentification/connexion.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(153, 53, 86, 0.2);
        }
        .card-title {
            color: #993556;
            font-weight: bold;
        }
        .btn-qcm {
            background-color: #993556;
            color: white;
            border-radius: 10px;
            padding: 10px 30px;
            font-size: 1.1rem;
            border: none;
        }
        .btn-qcm:hover {
            background-color: #7a2843;
            color: white;
        }
        .icon {
            font-size: 4rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-5 text-center" style="max-width: 600px; width: 100%;">
            <div class="icon mb-3">🧶</div>
            <h2 class="card-title mb-3">Publier une annonce</h2>
            <p class="text-muted mb-2">Avant de publier votre création, vous devez <strong>passer un QCM</strong> pour valider vos connaissances.</p>
            <p class="text-muted mb-4">Le QCM contient <strong>10 questions</strong> sur le crochet. Vous devez obtenir au moins <strong>10/20</strong> pour publier votre annonce.</p>
            <a href="qcm.php" class="btn btn-qcm">Passer le QCM 🧵</a>
        </div>
    </div>
    <a href="../index.php" class="btn btn-sm mb-3" style="background-color: #993556; color: white;">Retour à l'accueil</a>
</body>
</html>
