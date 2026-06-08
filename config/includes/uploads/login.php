<?php
session_start();

$_SESSION['username'] = '';

$currentName = $_SESSION['username'];


$connection = mysqli_connect('localhost', 'root', '', 'invader_bar');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $emailInput = trim($_POST['mail'] ?? '');
    $passwordInput = trim($_POST['password'] ?? '');

    if (!empty($emailInput) && !empty($passwordInput)) {

        $query = "SELECT * FROM users WHERE mail = '$emailInput'";
        $queryResult = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($queryResult);

        if ($userData === null) {
            echo "<p class='text-danger text-center mt-3'>Adresse mail invalide</p>";
        } else {
            $_SESSION['mail'] = $emailInput;
            header('Location: tableau.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #6c757d;">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8b5a2b;">
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

                <a href="register.php" class="btn btn-info">Register</a>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

        <form method="POST" class="bg-white p-5 rounded shadow" style="width: 450px;">

            <h2 class="text-center mb-4">Login</h2>

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

            <button type="submit" class="btn btn-primary w-100">Sign in</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```


