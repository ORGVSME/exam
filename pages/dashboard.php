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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    
</head>
<body>

<div class="container">
    <div class="profile-card text-center">

        <?php if (!empty($membre['photo'])): ?>
            <img src="../uploads/<?= htmlspecialchars($membre['photo']) ?>" alt="Photo de profil">
        <?php else: ?>
            <img src="https://via.placeholder.com/120?text=Profil" alt="Photo de profil">
        <?php endif; ?>

        <h3 class="mt-2"><?= htmlspecialchars($membre['nom']) ?></h3>
        <p class="mb-1"><strong>Email :</strong> <?= htmlspecialchars($membre['email']) ?></p>
        <p class="mb-1"><strong>Ville :</strong> <?= htmlspecialchars($membre['ville']) ?></p>

        <div class="d-grid gap-2 mt-4">
            <a href="liste_objets.php" class="btn btn-outline-primary">📦 Voir la liste des objets</a>
            <a href="membre.php" class="btn btn-outline-primary"> voir la liste des membres de ce cite web </a>
            <a href="emprunt.php" class="btn btn-outline-primary"> voir la liste des emprunts </a>
            <a href="logout.php" class="btn btn-danger"> Se déconnecter</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
