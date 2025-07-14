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

    <h2>Inscription d'un nouveau membre</h2>

    <form action="process_inscription.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required maxlength="50" />

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required />

        <label for="genre">Genre :</label>
        <select id="genre" name="genre" required>
            <option value="">-- Sélectionnez --</option>
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
            <option value="A">Autre</option>
        </select>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required maxlength="50" />

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required maxlength="50" />

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required maxlength="50" />

        <label for="photo">Photo (optionnelle) :</label>
        <input type="file" id="photo" name="photo" accept="image/*" />

        <input type="submit" value="S'inscrire" />
    </form>

</body>
</html>
