<?php
function dbconnect() {
    $host = 'localhost';
    $user = 'ETU003960';  // Vérifie bien ce nom d'utilisateur
    $pass = 'u78R7nwy'; // Remplace avec le bon mot de passe
    $dbname = 'db_s2_ETU003960';

    $db = mysqli_connect($host, $user, $pass, $dbname);

    if (!$db) {
        die('Erreur de connexion : ' . mysqli_connect_error());
    }

    return $db;
}
?>

