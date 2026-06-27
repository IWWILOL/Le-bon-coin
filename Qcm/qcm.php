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
                <?php foreach ($options as $option): ?>
                    <label>
                        <input type="radio" name="reponse[<?php echo $question['id']; ?>]" value="<?php echo htmlspecialchars($option); ?>" required>
                        <?php echo htmlspecialchars($option); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
            <hr>
        <?php endforeach; ?>
        <button type="submit">Soumettre</button>
    </form>
</body>
</html>