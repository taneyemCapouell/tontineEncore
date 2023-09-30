<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["date_ouverture"]) && !empty($_POST["date_ouverture"])
        && isset($_POST["date_fermeture"]) && !empty($_POST["date_fermeture"])
        && isset($_POST["banques_ID"]) && !empty($_POST["banques_ID"])
    ) {

        // on recupere les donnees en les protegeant
        $date_ouverture = strip_tags($_POST["date_ouverture"]);
        $date_fermeture = strip_tags($_POST["date_fermeture"]);
        $banques_ID = strip_tags($_POST["banques_ID"]);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO session_banques (date_ouverture,date_fermeture,banques_ID) 
        VALUES(:date_ouverture,:date_fermeture,:banques_ID)";
        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":date_ouverture", $date_ouverture);
        $requette->bindValue(":date_fermeture", $date_fermeture);
        $requette->bindValue(":banques_ID", $banques_ID);
        $requette->execute();
        $session_banques=$requette->fetch();
        $_SESSION["statut"] = $session_banques["statut"];
        
        // $sesssion = $requette->fetch();
        $_SESSION['message'] = "Session de banque ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/banques_detail.php");
        exit;
        //on se deconnecte a la base de donnees
        require_once("deconnexion.php");
    } else {
        // echo"capo";exit;
        $_SESSION['message'] = "veillez remplir tout les champs";
        $_SESSION['status'] = "danger";
        header("location:../../view/banques_detail.php");
        exit;
    }
}

if (isset($_POST["modifier"])) {
    if (
        isset($_POST["session_banques_ID"]) && !empty($_POST["session_banques_ID"])
        && isset($_POST["date_ouverture"]) && !empty($_POST["date_ouverture"])
        && isset($_POST["date_fermeture"]) && !empty($_POST["date_fermeture"])
    ) {

        // on recupere les donnees en les protegeant
        $session_banques_ID = $_POST["session_banques_ID"];
        $requette->bindValue(":date_ouverture", $date_ouverture);
        $requette->bindValue(":date_fermeture", $date_fermeture);

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE session_banques  SET date_ouverture=:date_ouverture,date_fermeture=:date_fermeture 
        WHERE session_banques_ID=:session_banques_ID';
        // echo"capo";exit();

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":date_ouverture", $date_ouverture);
        $requette->bindValue(":date_fermeture", $date_fermeture);
        $requette->bindValue(":session_banques_ID", $session_banques_ID);
        $requette->execute();

        $_SESSION['message'] = "Session modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/sessionBanques_liste.php");
        exit;
        require("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet veiller remplir tous les champs';
        $_SESSION['status'] = 'danger';
        header("location:../../view/sessionBanques_modifier.php");
        exit;
    }
}

require("../../dbconfig/connexion.php");
if (isset($_POST["fermer"]) && !empty($_POST["fermer"])) {
    
        $sql = "UPDATE session_banques SET statut = 0  WHERE  session_banques_ID = 1";
        $requette = $bdd->prepare($sql);
        $requette->execute();
        // $_SESSION['statut'] = $requette["statut"];

        $_SESSION['message'] = "Session fermee";
        $_SESSION['status'] = "success";
        header("location:../../view/banques_detail.php");
        exit;
}
