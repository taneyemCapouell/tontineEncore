<?php
// on demare la session
session_start();

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // on se connecte a la base deonnees
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM license WHERE license_ID = :license_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':license_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $license = $requette->fetch();

    // on verifie si l'id existe 
    if (!$license) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:../../view/admin/license_liste.php");
        exit;
    }

    $sql = "DELETE FROM license WHERE license_ID = :license_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':license_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    $_SESSION['message'] = "License supprimer";
    $_SESSION['status'] = "success";
    header("location:../../view/admin/license_liste.php");
    exit;
} else {    
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:../../view/admin/license_liste.php");
}
