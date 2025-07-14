<?php
require_once '../inc/function.php';

$selectedCategorie = $_GET['categorie'] ?? 'all';
$categories = getCategories();
$objets = getObjetsAvecEmprunt($selectedCategorie);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <style>
        .card {
            width: 18rem;
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
<div class="container mt-4">

    <h2>Liste des objets</h2>

    <form method="get" class="mb-4">
        <label for="categorie" class="form-label">Filtrer par catégorie :</label>
        <select name="categorie" id="categorie" class="form-select" style="max-width:300px; display:inline-block;">
            <option value="all" <?= $selectedCategorie === 'all' ? 'selected' : '' ?>>Tout</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id_categorie'] ?>" <?= $selectedCategorie == $cat['id_categorie'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nom_categorie']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary ms-2">Filtrer</button>
    </form>

    <div class="cards-container">
        <?php if (count($objets) === 0): ?>
            <p>Aucun objet trouvé.</p>
        <?php else: ?>
            <?php foreach ($objets as $obj): ?>
                <?php
                // Construire le chemin image, mettre default.jpg si aucune image
                $imgSrc = '../assets/picture/' . ($obj['nom_image'] ?? 'default.jpg');
                $emprunte = $obj['date_emprunt'] ? 'Oui' : 'Non';
                $dateRetour = $obj['date_retour'] ?? '-';
                ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img-top" alt="<?= htmlspecialchars($obj['nom_objet']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                        <p class="card-text">
                            <strong>Catégorie :</strong> <?= htmlspecialchars($obj['nom_categorie']) ?><br>
                            <strong>Propriétaire :</strong> <?= htmlspecialchars($obj['proprietaire']) ?><br>
                            <strong>Emprunté :</strong> <?= $emprunte ?><br>
                            <strong>Date retour :</strong> <?= $dateRetour ?>
                        </p>
                        <a href="#" class="btn btn-primary">Voir détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
