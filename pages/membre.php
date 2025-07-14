<?php
session_start();
require_once '../inc/function.php';

$membres = get_membre();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Membres du site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            margin-top: 30px;
        }
        .table thead th {
            background-color: #0d6efd;
            color: white;
        }
        .container {
            max-width: 900px;
        }
        .navbar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- Barre de navigation simple -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestion des Membres</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste_objets.php">Objets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="emprunt.php">Emprunts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Retour</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <h1 class="text-center mb-4">👥 Liste des membres</h1>

    <?php if (count($membres) === 0): ?>
        <div class="alert alert-warning text-center">Aucun membre trouvé.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($membres as $membre): ?>
                    <tr>
                        <td><?= htmlspecialchars($membre['nom']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
