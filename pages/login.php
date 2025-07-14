<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2 class="text-center mb-4">Connexion</h2>
    <form action="process_login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100">Se connecter</button>
    </form>
     <a href="index.php" class="btn btn-danger">retour</a>
</body>
</html>
