<?php
require_once '../inc/function.php';
session_start();

if (!isset($_SESSION['membre'])) {
    die("Vous devez être connecté pour ajouter un objet.");
}

$id_membre = $_SESSION['membre']['id'];
$nom_objet = $_POST['nom_objet'] ?? '';
$id_categorie = $_POST['categorie'] ?? '';

if (empty($nom_objet) || empty($id_categorie) || empty($_FILES['images'])) {
    die("Tous les champs sont requis.");
}


$conn = dbconnect();

$query = "INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'sii', $nom_objet, $id_categorie, $id_membre);
mysqli_stmt_execute($stmt);
$id_objet = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);


$uploadDir = '../assets/picture/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$images = $_FILES['images'];
for ($i = 0; $i < count($images['name']); $i++) {
    if ($images['error'][$i] === 0) {
        $imageName = uniqid() . '_' . basename($images['name'][$i]);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($images['tmp_name'][$i], $imagePath)) {
            // Enregistrer dans la base
            $stmt = mysqli_prepare($conn, "INSERT INTO images_objet (id_objet, nom_image) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, 'is', $id_objet, $imageName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($conn);

// Redirection après ajout
header("Location: liste_objets.php");
exit;
?>