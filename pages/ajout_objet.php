<?php
require_once '../inc/function.php';
session_start();

if (!isset($_SESSION['membre'])) {
    header("Location: connexion.php");
    exit;
}

$categories = getCategories(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un objet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="ajout.css">
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="mb-4 text-center">+ Ajouter un objet</h2>

        <form action="traitement_ajout_objet.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom_objet" class="form-label">Nom de l'objet</label>
                <input type="text" class="form-control" id="nom_objet" name="nom_objet" required>
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <select class="form-select" name="categorie" id="categorie" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id_categorie'] ?>"><?= htmlspecialchars($cat['nom_categorie']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Images (la première sera l'image principale)</label>
                <input type="file" class="form-control" name="images[]" multiple required accept="image/*">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Ajouter l'objet</button>
                <br>
                
            </div>
            <br>
            <div class="d-grid">
            <button class="btn btn-success" ><a href="liste_objets.php">Retour</a></button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
