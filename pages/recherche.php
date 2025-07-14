<?php
require_once '../inc/function.php';

// Vérifier si une recherche a été soumise
$recherche = [];
if (isset($_POST['a']) && !empty(trim($_POST['a']))) {
    $recherche = rechercher($_POST['a']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Résultats des recherches</h1>
        
        <?php if (empty($recherche)): ?>
            <div class="alert alert-info" role="alert">
                Aucun résultat trouvé.
            </div>
        <?php else: ?>
            
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Numéro Employé</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Département</th>
                        <th>Numéro Département</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recherche as $r): ?>
                        <tr onclick="window.location.href = 'fiche.php?id=<?php echo $r['emp_no']; ?>'">
                            <td><?php echo ($r['emp_no']); ?></td>
                            <td><?php echo ($r['first_name']); ?></td>
                            <td><?php echo ($r['last_name']); ?></td>
                            <td><?php echo ($r['dept_name']); ?></td>
                            <td><?php echo ($r['dept_no']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                 <a href="index.php">
                <button type="button" class="btn btn-outline-success">Retour à l'accueil</button>
                 </a>
        </div>
    </div>
    </div>
    
    

</body>
</html>