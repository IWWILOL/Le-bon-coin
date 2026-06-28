<?php
session_start();
require '../db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Authentification/connexion.php');
    exit;
}
$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
$result = mysqli_query($conn, $sql);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-image: url('https://i.pinimg.com/736x/37/7d/b6/377db6cea8ba77dc96fa49a4c9e08a15.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .card { border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(153, 53, 86, 0.2); }
        .card-title { color: #993556; font-weight: bold; }
        .btn-qcm {
            background-color: #993556;
            color: white;
            border-radius: 10px;
            padding: 10px 30px;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
        }
        .btn-qcm:hover { background-color: #7a2843; color: white; }
        .icon { font-size: 4rem; }
        label { color: #993556; font-weight: bold; }

        #section-avant {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }

        #section-qcm {
            display: none;
            background-color: rgba(255,255,255,0.85);
            padding: 30px;
            border-radius: 20px;
            margin: 20px;
        }

        #timer {
            display: none;
            font-size: 24px;
            font-weight: bold;
            color: red;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <!-- SECTION 1: Avant QCM -->
    <div id="section-avant">
        <div class="card p-5 text-center" style="max-width: 600px; width: 100%;">
            <div class="icon mb-3">🧶</div>
            <h2 class="card-title mb-3">Publier une annonce</h2>
            <p class="text-muted mb-2">Avant de publier votre création, vous devez <strong>passer un QCM</strong> pour valider vos connaissances.</p>
            <p class="text-muted mb-4">Le QCM contient <strong>10 questions</strong> sur le crochet. Vous devez obtenir au moins <strong>10/20</strong> pour publier votre annonce.</p>
            <button onclick="lancerQcm()" class="btn-qcm">Passer le QCM 🧵</button>
            <a href="../index.php" class="btn btn-sm mt-3 d-block" style="background-color: #993556; color: white;">Retour à l'accueil</a>
        </div>
    </div>

    <!-- SECTION 2: QCM -->
    <div id="section-qcm">
        <div id="timer">10:00</div>
        <form id="form-qcm" action="resultat.php" method="post">
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
            <button type="submit" class="btn-qcm mb-3">Soumettre</button>
        </form>
    </div>

<script>
let soumis = false;
let avertissements = 0;
let timerInterval = null;
let qcmStarted = false;

function lancerQcm() {
     qcmStarted = true;
    // Fullscreen
    const el = document.documentElement;
    if (el.requestFullscreen) el.requestFullscreen();
    else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
    else if (el.mozRequestFullScreen) el.mozRequestFullScreen();

    // Animation disparition
    const avant = document.getElementById('section-avant');
    avant.style.maxHeight = avant.scrollHeight + 'px';
    setTimeout(function() {
        avant.style.opacity = '0';
        avant.style.maxHeight = '0';
    }, 10);

    // Afficher QCM
    setTimeout(function() {
        avant.style.display = 'none';
        document.getElementById('timer').style.display = 'block';
        document.getElementById('section-qcm').style.display = 'block';
        timerInterval = setInterval(updateTimer, 1000);
    }, 500);
}

// Fullscreen change
document.addEventListener('fullscreenchange', function() {
    if (!document.fullscreenElement && !soumis) {
        alert("⚠️ Vous avez quitté le plein écran. Votre tentative peut être annulée.");
    }
});

// Flag soumission
document.getElementById('form-qcm').addEventListener('submit', function() {
    soumis = true;
});

// Changement d'onglet
document.addEventListener('visibilitychange', function() {
    if (document.hidden && !soumis && qcmStarted) {
        avertissements++;
        if (avertissements >= 3) {
            alert("⚠️ Trop de changements d'onglet. Tentative annulée.");
            soumis = true;
            window.location.reload();
        } else {
            alert("⚠️ Avertissement " + avertissements + "/3 : changement d'onglet détecté !");
        }
    }
});

// Désactiver clic droit / copier / coller
document.addEventListener('contextmenu', function(e) { e.preventDefault(); });
document.addEventListener('copy', function(e) { e.preventDefault(); });
document.addEventListener('paste', function(e) { e.preventDefault(); });
document.addEventListener('cut', function(e) { e.preventDefault(); });
document.addEventListener('selectstart', function(e) { e.preventDefault(); });

// Timer
let tempsRestant = 10 * 60;
function updateTimer() {
    const minutes = Math.floor(tempsRestant / 60);
    const secondes = tempsRestant % 60;
    document.getElementById('timer').textContent =
        minutes + ':' + (secondes < 10 ? '0' : '') + secondes;
    if (tempsRestant <= 0) {
        clearInterval(timerInterval);
        alert("⏱️ Temps écoulé ! Vos réponses sont soumises automatiquement.");
        soumis = true;
        document.getElementById('form-qcm').submit();
    }
    tempsRestant--;
}
</script>

</body>
</html>