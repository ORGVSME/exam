<?php
require_once '../inc/connexion.php';

// Vérifie que tous les champs requis sont bien présents
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = dbconnect();

    // Récupération sécurisée des champs
    $nom = $_POST['nom'] ?? '';
    $date_naissance = $_POST['date_naissance'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $email = $_POST['email'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $photo = '';

    // Gestion de la photo si elle est envoyée
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = basename($_FILES['photo']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $photo = $filename;
        }
    }

    // Requête d’insertion
    $query = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mot_de_passe, photo)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $nom, $date_naissance, $genre, $email, $ville, $mot_de_passe, $photo);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: login.php?success=1");
        exit;
    } else {
        echo "Erreur lors de l'inscription.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
