<?php
require "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['nom'] as $id => $nom) {
        $email = $_POST['email'][$id];
        $role = $_POST['role'][$id];
        $actif = $_POST['actif'][$id];

        mysqli_query($conn, "UPDATE users SET nom='$nom', email='$email', role='$role', actif='$actif' WHERE id=$id");
    }
    header('Location: administration.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>
    <form action="administration.php" method="POST">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actif</th>
                <th>Créé le</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><input type="text" name="nom[<?= $row['id'] ?>]" value="<?= $row['nom'] ?>"></td>
                <td><input type="text" name="email[<?= $row['id'] ?>]" value="<?= $row['email'] ?>"></td>
                <td>
                    <select name="role[<?= $row['id'] ?>]">
                        <option value="membre" <?= $row['role'] === 'membre' ? 'selected' : '' ?>>Membre</option>
                        <option value="admin" <?= $row['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </td>
                <td>
                    <select name="actif[<?= $row['id'] ?>]">
                        <option value="1" <?= $row['actif'] == 1 ? 'selected' : '' ?>>Oui</option>
                        <option value="0" <?= $row['actif'] == 0 ? 'selected' : '' ?>>Non</option>
                    </select>
                </td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <button type="submit" formaction="supprimer-user.php" formmethod="POST" name="id" value="<?= $row['id'] ?>">Supprimer</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <button type="submit">Enregistrer toutes les modifications</button>
    </form>
    <br>
    <hr>
    <br>
    <a href="../index.php">Retourner a la page d'acceuil</a>
</body>
</html>