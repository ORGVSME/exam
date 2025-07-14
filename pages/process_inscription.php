<?php
require_once '../inc/function.php';

// Vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base
    $conn = dbconnect();

    // Récupération des champs avec sécurisation
    $nom            = mysqli_real_escape_string($conn, $_POST['nom']);
    $date_naissance = $_POST['date_naissance'];
    $genre          = $_POST['genre'];
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $ville          = mysqli_real_escape_string($conn, $_POST['ville']);
    $mot_de_passe   = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // HASH sécurisé
    $photo_name     = null;

    // Gestion de la photo si fournie
    if (!empty($_FILES['photo']['name'])) {
        $uploadDir = '../uploads/';
        $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid('photo_', true) . '.' . $extension;
        $uploadPath = $uploadDir . $newFileName;

        // Créer le dossier s’il n’existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Déplacement du fichier
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
            $photo_name = $newFileName;
        } else {
            die("Erreur lors de l'upload de la photo.");
        }
    }

    // Requête d'insertion
    $stmt = mysqli_prepare($conn, "
        INSERT INTO membre (nom, date_naissance, genre, email, ville, mot_de_passe, photo)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    mysqli_stmt_bind_param($stmt, "sssssss", $nom, $date_naissance, $genre, $email, $ville, $mot_de_passe, $photo_name);

    // Exécution
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Inscription réussie ! <a href='index.php'>Retour à l'accueil</a></p>";
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Accès refusé.";
}
?>
