<?php
require_once '../inc/connexion.php';
session_start();

// Vérifie que les champs sont remplis
if (!isset($_POST['email'], $_POST['mot_de_passe'])) {
    die("Tous les champs sont requis.");
}

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Connexion à la base
$conn = dbconnect();

// Préparer la requête pour éviter les injections SQL
$query = "SELECT * FROM membre WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Vérifie le mot de passe (non haché ici)
    if ($row['mot_de_passe'] === $mot_de_passe) {
        // Connexion réussie → enregistrer l'utilisateur dans la session
        $_SESSION['membre'] = [
            'id' => $row['id_membre'],
            'nom' => $row['nom'],
            'email' => $row['email'],
            'ville' => $row['ville'],
            'photo' => $row['photo']
        ];

        // Redirection vers une page de tableau de bord
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Aucun compte trouvé avec cet email.";
}
?>
