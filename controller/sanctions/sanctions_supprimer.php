<?php
// on demare la session
session_start();

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // on se connecte a la base deonnees
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM sanctions WHERE sanctions_ID = :sanctions_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':sanctions_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();
    $sessions = $requette->fetch();

    // on verifie si l'id existe 
    if (!$sessions) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:../../view/session_liste.php");
        exit;
    }

    $sql = "DELETE FROM sanctions WHERE sanctions_ID = :sanctions_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':sanctions_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();
    $_SESSION['message'] = "Sanction supprimer";
    $_SESSION['status'] = "success";
    header("location:../../view/sanctions_liste.php");
    exit;
} else {    
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:../../view/sanctions_liste.php");
}
