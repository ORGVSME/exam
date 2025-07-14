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

function searchObjets($categorie = 'all', $nom = '', $disponible = false) {
    $conn = dbconnect();

    $query = "SELECT o.*, c.nom_categorie, m.nom AS proprietaire, e.date_emprunt, e.date_retour, i.nom_image
              FROM objet o
              JOIN categorie_objet c ON o.id_categorie = c.id_categorie
              JOIN membre m ON o.id_membre = m.id_membre
              LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
              LEFT JOIN images_objet i ON o.id_objet = i.id_objet";

    $conditions = [];

    // Appliquer les filtres uniquement si renseignés
    if ($categorie !== 'all') {
        $conditions[] = "o.id_categorie = " . intval($categorie);
    }

    if (!empty(trim($nom))) {
        $conditions[] = "o.nom_objet LIKE '%" . mysqli_real_escape_string($conn, $nom) . "%'";
    }

    if ($disponible) {
        $conditions[] = "e.id_emprunt IS NULL";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $query .= " GROUP BY o.id_objet ORDER BY o.nom_objet ASC";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getObjetById($id)
{
    $conn = dbconnect();
    $stmt = $conn->prepare("SELECT * FROM objet WHERE id_objet = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function get_membre()
{
    if ($db = dbconnect()) {
        $request = "SELECT id_membre, nom FROM membre";
        $list = array();
        $sql = mysqli_query($db, $request);

        while ($ligne = mysqli_fetch_assoc($sql)) {
            $list[] = array(
                "id_membre" => $ligne['id_membre'],
                "nom" => $ligne['nom']
            );
        }
        return $list;
    }
    return [];
}

function getEmpruntsComplet() {
    if ($db = dbconnect()) {
        $sql = "SELECT 
                    e.id_emprunt,
                    o.nom_objet,
                    m1.nom AS proprietaire,
                    m2.nom AS emprunteur,
                    e.date_emprunt,
                    e.date_retour
                FROM emprunt e
                JOIN objet o ON e.id_objet = o.id_objet
                JOIN membre m1 ON e.id_proprietaire = m1.id_membre
                JOIN membre m2 ON e.id_emprunteur = m2.id_membre
                ORDER BY e.date_emprunt DESC";

        $result = mysqli_query($db, $sql);
        $emprunts = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $emprunts[] = $row;
        }

        return $emprunts;
    }

    return []; 
}


?>


