<?php
require('connexion.php');


function getObjetsAvecEmprunt($idCategorie = null)
{
    $conn = dbconnect();

    $query = "
        SELECT 
            o.id_objet,
            o.nom_objet,
            c.nom_categorie,
            m.nom AS proprietaire,
            e.date_emprunt,
            e.date_retour,
            io.nom_image
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN membre m ON o.id_membre = m.id_membre
        LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
        LEFT JOIN images_objet io ON o.id_objet = io.id_objet
    ";

    if ($idCategorie !== null && $idCategorie !== 'all') {
        $query .= " WHERE o.id_categorie = " . intval($idCategorie);
    }

    $query .= " GROUP BY o.id_objet ORDER BY o.id_objet";

    $result = mysqli_query($conn, $query);
    $objets = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }

    return $objets;
}

function getCategories() {
    $conn = dbconnect();
    $result = mysqli_query($conn, "SELECT * FROM categorie_objet ORDER BY nom_categorie");
    $cats = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cats[] = $row;
    }
    return $cats;
}
?>


