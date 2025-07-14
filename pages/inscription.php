<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css" />
    <style>
        body {
            margin: 20px;
            font-family: Arial, sans-serif;
            max-width: 500px;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            cursor: pointer;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px;
        }
    </style>
</head>
<body>

<form action="process_membre.php" method="POST" enctype="multipart/form-data">
    <label>Nom : <input type="text" name="nom" required></label><br>
    <label>Date de naissance : <input type="date" name="date_naissance" required></label><br>
    <label>Genre : 
        <select name="genre" required>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
        </select>
    </label><br>
    <label>Email : <input type="email" name="email" required></label><br>
    <label>Ville : <input type="text" name="ville" required></label><br>
    <label>Mot de passe : <input type="password" name="mot_de_passe" required></label><br>
    <label>Photo de profil : <input type="file" name="photo" accept="image/*" required></label><br>
    <input type="submit" value="S'inscrire">
</form>


</body>
</html>