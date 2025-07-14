<?php
session_start();

if (!isset($_SESSION['membre'])) {
    header("Location: login.php");
    exit;
}

$membre = $_SESSION['membre'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Bienvenue, <?= htmlspecialchars($membre['nom']) ?> !</h2>
        <p>Email : <?= htmlspecialchars($membre['email']) ?></p>
        <p>Ville : <?= htmlspecialchars($membre['ville']) ?></p>

        <?php if ($membre['photo']): ?>
            <img src="../uploads/<?= htmlspecialchars($membre['photo']) ?>" alt="Photo de profil" width="150">
        <?php endif; ?>

        <br><br>
        <h3><a href="liste_objets.php">voici la liste des objets</a></h3>

        <br><br>
        <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
    </div>
</body>
</html>
