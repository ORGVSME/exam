<?php
require_once '../inc/function.php';
session_start();

if (!isset($_SESSION['membre'])) {
    header('Location: login.php');
    exit;
}

$emprunts = getEmpruntsComplet(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des emprunts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            margin-top: 30px;
        }
        .navbar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Historique des emprunts</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link" href="liste_objets.php">Objets</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Deconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="text-center mb-4">📚 Emprunts effectués</h1>

    <?php if (count($emprunts) === 0): ?>
        <div class="alert alert-warning text-center">Aucun emprunt trouvé.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom de l'objet</th>
                    <th>Propriétaire</th>
                    <th>Emprunteur</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprunts as $emp): ?>
                    <tr>
                        <td><?= $emp['id_emprunt'] ?></td>
                        <td><?= htmlspecialchars($emp['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($emp['proprietaire']) ?></td>
                        <td><?= htmlspecialchars($emp['emprunteur']) ?></td>
                        <td><?= htmlspecialchars($emp['date_emprunt']) ?></td>
                        <td><?= $emp['date_retour'] ?? 'Non défini' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
