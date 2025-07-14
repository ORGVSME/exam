<?php
require_once '../inc/connexion.php';
session_start();

// Vérifie que tous les champs du formulaire sont envoyés
if (
    isset($_POST['nom'], $_POST['date_naissance'], $_POST['genre'], $_POST['email'],
    $_POST['ville'], $_POST['mot_de_passe']) && isset($_FILES['photo'])
) {
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Upload de la photo
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_path = "../uploads/" . basename($photo_name);

    if (move_uploaded_file($photo_tmp, $photo_path)) {
        // Connexion à la base
        $conn = dbconnect();

        // Préparer et exécuter l’insertion
        $query = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mot_de_passe, photo) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssssss', $nom, $date_naissance, $genre, $email, $ville, $mot_de_passe, $photo_name);

        if (mysqli_stmt_execute($stmt)) {
            echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
        } else {
            echo "Erreur lors de l'inscription : " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Erreur lors de l’upload de la photo.";
    }
} else {
    echo "Tous les champs sont requis.";
}
?>