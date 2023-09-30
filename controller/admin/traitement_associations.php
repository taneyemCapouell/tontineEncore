<?php
// on demare la session
session_start();

if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["nom_associations"]) && !empty($_POST["nom_associations"])
        // && isset($_POST["localisation"]) && !empty($_POST["localisation"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        // && isset($_POST["slogan_associations"]) && !empty($_POST["slogan_associations"])
        && isset($_POST["ville"]) && !empty($_POST["ville"])
        && isset($_POST["logo_associations"]) && !empty($_POST["logo_associations"])
    ) {

        // on se connecte a la base de donnees
        require_once("../../dbconfig/connexion.php");

        // on recupere les donnees en les protegeant
        $nom_associations = strip_tags($_POST["nom_associations"]);
        $localisation = strip_tags($_POST["localisation"]);
        $email = $_POST["email"];
        $slogan_associations = strip_tags($_POST["slogan_associations"]);
        $ville = strip_tags($_POST["ville"]);
        $logo_associations = $_POST["logo_associations"];
        $dataImage = base64_encode(file_get_contents($logo_associations));

        // on insere les donnees dans la base de donnees
        $sql = 'INSERT INTO associations (nom,email,localisation,date_creation,slogan,ville,logo) 
        VALUES(:nom_associations,:email,:localisation,:date_creation,:slogan_associations,:ville,:logo_associations)';
        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom_associations", $nom_associations);
        $requette->bindValue(":email", $email);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":date_creation", date("Y-m-d"));
        $requette->bindValue(":slogan_associations", $slogan_associations);
        $requette->bindValue(":ville", $ville);
        $requette->bindValue(":logo_associations", $dataImage);

        // on execute la requette
        $requette->execute();

        $associations = $requette->fetchALL();

        $_SESSION['message'] = "Association ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/admin/associations_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/admin/associations_ajouter.php");
        exit;
    }
}

if (isset($_POST["modifier"])) {
    if (
        isset($_POST["associations_ID"]) && !empty($_POST["associations_ID"])
        && isset($_POST["nom_associations"]) && !empty($_POST["nom_associations"])
        && isset($_POST["localisation"]) && !empty($_POST["localisation"])
        && isset($_POST["email"]) && !empty($_POST["email"])
    ) {

        // on se connecte a la base de donnees
        require_once("../../dbconfig/connexion.php");

        // on recupere les donnees en les protegeant
        $associations_ID = strip_tags($_POST["associations_ID"]);
        $nom_associations = strip_tags($_POST["nom_associations"]);
        $localisation = strip_tags($_POST["localisation"]);
        $email = $_POST["email"];
        $slogan_associations = strip_tags($_POST["slogan_associations"]);
        $ville = strip_tags($_POST["ville"]);
        $logo_associations = $_POST["logo_associations"];
        $dataImage = base64_encode(file_get_contents($logo_associations));

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE associations  SET nom=:nom_associations,email=:email,localisation=:localisation,
         slogan=:slogan_associations ,logo=:logo_associations,ville=:ville
        WHERE associations_ID=:associations_ID;';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":nom_associations", $nom_associations);
        $requette->bindValue(":email", $email);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":slogan_associations", $slogan_associations);
        $requette->bindValue(":logo_associations", $dataImage);
        $requette->bindValue(":ville", $ville);
        $requette->bindValue(":associations_ID", $associations_ID);
        $requette->execute();

        $_SESSION['message'] = 'Association Modifier';
        $_SESSION['status'] = 'success';
        header("location:../../view/admin/associations_liste.php");
        exit;
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/admin/associations_modifier.php");
        exit;
    }
}
