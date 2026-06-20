<?php
session_start();

$_SESSION['username'] = $_SESSION['username'] ?? '';
$currentName = $_SESSION['username'];

$connection = mysqli_connect('localhost', 'root', '', 'cloud_diva');
if (!$connection) {
    die("Erreur de connexion à la base de données.");
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $emailInput = trim($_POST['mail'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');

    if (!empty($emailInput) && !empty($passwordInput)) {

        
        $query = "SELECT id, nom, email, password, role, actif FROM users WHERE email = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $emailInput);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $userData = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($userData === null) {
            $errorMessage = "Adresse mail ou mot de passe incorrect.";
        } elseif ($userData['actif'] != 1) {
            $errorMessage = "Ce compte a été désactivé.";
        } elseif (!password_verify($passwordInput, $userData['password'])) {
            $errorMessage = "Adresse mail ou mot de passe incorrect.";
        } else {
            $_SESSION['mail'] = $userData['email'];
            $_SESSION['username'] = $userData['nom'];
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['role'];

            header('Location: index.html');
            exit;
        }
    } else {
        $errorMessage = "Merci de remplir tous les champs.";
    }
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #ffe4ec;">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e75480;">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">Invader</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="tableau.php">Users</a>
                    </li>
                </ul>

                <a href="config/includes/uploads/register.php" class="btn btn-info">Register</a>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

        <form method="POST" class="bg-white p-5 rounded shadow" style="width: 450px;">

            <h2 class="text-center mb-4">Login</h2>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
            <?php endif; ?>

            <?php if (isset($_GET['inscription']) && $_GET['inscription'] === 'ok'): ?>
                <div class="alert alert-success">Inscription réussie, vous pouvez vous connecter.</div>
            <?php endif; ?>

            <?php if (isset($_GET['deconnexion']) && $_GET['deconnexion'] === 'ok'): ?>
                <div class="alert alert-success">Vous avez été déconnecté.</div>
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="mail" class="form-control" placeholder="Enter your e-mail" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

            <button type="submit" class="btn w-100" style="background-color: #e75480; color: white;">Sign in</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

