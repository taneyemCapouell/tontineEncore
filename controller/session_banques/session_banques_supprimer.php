<?php
// on demare la session
session_start();

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // on se connecte a la base donnees
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM session_banques WHERE session_banques_ID=:session_banques_ID;";
    // on prepare la requette 
    $requette  = $bdd->prepare($sql);
    // on accroche les parametres
    $requette->bindValue(':session_banques_ID', $id, PDO::PARAM_INT);
    // on execute la requette 
    $requette->execute();
    $session_banques = $requette->fetch();

    // on verifie si l'id existe 
    if (!$session_banques) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:../../view/banques_detail.php");
        exit;
    }

    $sql = "DELETE FROM session_banques WHERE session_banques_ID=:session_banques_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':session_banques_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();
    $_SESSION['message'] = "Session supprimer";
    $_SESSION['status'] = "success";
    header("location:../../view/banques_detail.php");
    exit;
} else {    
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:../../view/banques_detail.php");
}
