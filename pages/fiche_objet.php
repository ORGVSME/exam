<?php
require_once '../inc/function.php';
session_start();

$selectedCategorie = $_GET['categorie'] ?? 'all';
$searchNom = $_GET['nom'] ?? '';
$filtreDisponible = isset($_GET['disponible']);

$categories = getCategories();
$objets = searchObjets($selectedCategorie, $searchNom, $filtreDisponible);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            width: 18rem;
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">

    <h1 class="text-center mb-4">🎒 Liste des Objets</h1>

    <div class="d-grid">
        <a href="dashboard.php" class="btn btn-outline-secondary">Retour au tableau de bord</a>
    </div>

    <div class="d-flex justify-content-end mb-3 mt-4">
        <a href="ajout_objet.php" class="btn btn-success">+ Ajouter un objet</a>
    </div>

    <form method="get" class="row g-3 align-items-end mb-5">
        <div class="col-md-4">
            <label for="categorie" class="form-label">Catégorie :</label>
            <select name="categorie" id="categorie" class="form-select">
                <option value="all" <?= $selectedCategorie === 'all' ? 'selected' : '' ?>>Toutes les catégories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categorie'] ?>" <?= $selectedCategorie == $cat['id_categorie'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="nom" class="form-label">Nom de l'objet :</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($searchNom) ?>">
        </div>

        <div class="col-md-2">
            <div class="form-check mt-4">
                <input type="checkbox" name="disponible" id="disponible" class="form-check-input" <?= $filtreDisponible ? 'checked' : '' ?>>
                <label for="disponible" class="form-check-label">Disponible seulement</label>
            </div>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </form>

    <?php if (count($objets) === 0): ?>
        <div class="alert alert-warning text-center">Aucun objet trouvé.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($objets as $obj): ?>
                <?php
                $imgSrc = '../assets/picture/' . ($obj['nom_image'] ?? 'default.jpg');
                $estEmprunte = $obj['date_emprunt'] && (!$obj['date_retour'] || strtotime($obj['date_retour']) > time());
                ?>
                <div class="col">
                    <div class="card h-100 shadow">
                        <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img-top" alt="<?= htmlspecialchars($obj['nom_objet']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                            <p class="card-text">
                                <strong>Catégorie :</strong> <?= htmlspecialchars($obj['nom_categorie']) ?><br>
                                <strong>Propriétaire :</strong> <?= htmlspecialchars($obj['proprietaire']) ?><br>
                                <?php if ($estEmprunte): ?>
                                    <span class="text-danger">Indisponible jusqu’au <?= htmlspecialchars($obj['date_retour']) ?></span>
                                <?php else: ?>
                                    <span class="text-success">Disponible</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="card-footer text-center bg-white border-0 d-flex flex-column gap-2">
                            <a href="fiche_objet.php?id=<?= $obj['id_objet'] ?>" class="btn btn-outline-primary">Voir détails</a>
                            <?php if (!$estEmprunte): ?>
                                <a href="emprunt.php?id_objet=<?= $obj['id_objet'] ?>" class="btn btn-success">Emprunter</a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>Déjà emprunté</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
