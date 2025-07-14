<?php
require_once '../inc/function.php';

// Vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données
    $nom            = mysqli_real_escape_string(dbconnect(), $_POST['nom']);
    $date_naissance = $_POST['date_naissance'];
    $genre          = $_POST['genre'];
    $email          = mysqli_real_escape_string(dbconnect(), $_POST['email']);
    $ville          = mysqli_real_escape_string(dbconnect(), $_POST['ville']);
    $mot_de_passe   = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hasher le mot de passe
    $photo_name     = null;

    // Gestion du fichier photo
    if (!empty($_FILES['photo']['name'])) {
        $uploadDir = '../uploads/';
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('photo_', true) . '.' . $extension;
        $uploadPath = $uploadDir . $newFileName;

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Déplacer le fichier
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
            $photo_name = $newFileName;
        } else {
            echo "Erreur lors de l'envoi de la photo.";
            exit;
        }
    }

    // Insertion dans la base
    $conn = dbconnect();
    $stmt = mysqli_prepare($conn, "
        INSERT INTO membre (nom, date_naissance, genre, email, ville, mot_de_passe, photo)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    mysqli_stmt_bind_param($stmt, "sssssss", $nom, $date_naissance, $genre, $email, $ville, $mot_de_passe, $photo_name);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Inscription réussie ! <a href='index.php'>Retour à l'accueil</a></p>";
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Méthode non autorisée.";
}
?>
