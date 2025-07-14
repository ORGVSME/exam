<?php
require_once '../inc/function.php';

if (
    isset($_POST['id_objet'], $_POST['id_proprietaire'], $_POST['id_emprunteur'], $_POST['date_emprunt'], $_POST['duree']) &&
    is_numeric($_POST['id_objet']) &&
    is_numeric($_POST['id_proprietaire']) &&
    is_numeric($_POST['id_emprunteur']) &&
    is_numeric($_POST['duree'])
) {
    $id_objet = (int) $_POST['id_objet'];
    $id_proprietaire = (int) $_POST['id_proprietaire'];
    $id_emprunteur = (int) $_POST['id_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $duree = (int) $_POST['duree'];

    // Calcul de la date de retour
    $date_retour = date('Y-m-d', strtotime($date_emprunt . " + $duree days"));

    $conn = dbconnect();
    $stmt = $conn->prepare("INSERT INTO emprunt (id_objet, id_proprietaire, id_emprunteur, date_emprunt, date_retour) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $id_objet, $id_proprietaire, $id_emprunteur, $date_emprunt, $date_retour);

    if ($stmt->execute()) {
        header("Location: liste_objet.php");
        exit;
    } else {
        die("Erreur lors de l'emprunt : " . $stmt->error);
    }

} else {
    die("Données invalides.");
}
