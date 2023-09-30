<?php
// on demare la session
session_start();

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // on se connecte a la base deonnees
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM caisses WHERE caisses_ID = :caisses_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':caisses_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();
    $caisses = $requette->fetch();

    // on verifie si l'id existe 
    if (!$caisses) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:../../view/caisses_liste.php");
        exit;
    }

    $sql = "DELETE FROM caisses WHERE caisses_ID = :caisses_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':caisses_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();
    $_SESSION['message'] = "Caisse supprimer";
    $_SESSION['status'] = "success";
    header("location:../../view/caisses_liste.php");
    exit;
} else {    
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:../../view/caisses_liste.php");
}
