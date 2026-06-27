<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
   header('Location: ../Authentification/connexion.php');
    exit;
}
$sql="SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result=mysqli_query($conn,$sql);
$questions=mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form action="resultat.php" method="post">
        <?php foreach ($questions as $index => $question): ?>
            <div>
                <p><?php echo ($index + 1) . '. ' . htmlspecialchars($question['question']); ?></p>
                <?php
                $options = [
                    $question['reponse1'],
                    $question['reponse2'],
                    $question['reponse3'],
                    $question['reponse4']
                ];
                ?>
                <?php foreach ($options as $i => $option): ?>
                    <label>
                        <input type="radio" name="reponse[<?php echo $question['id']; ?>]" value="<?php echo $i + 1; ?>" required>
                        <?php echo htmlspecialchars($option); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
            <hr>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-sm mb-3" style="background-color: #993556; color: white;">Soumettre</button>
        <a href="../index.php" class="btn btn-sm mb-3" style="background-color: #993556; color: white;">Retour à l'accueil</a>
    </form>
</body>
</html>