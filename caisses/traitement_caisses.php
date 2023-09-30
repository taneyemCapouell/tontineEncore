
<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
$associations_ID = $_SESSION["user"]["associations_ID"];
if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["nom_caisse"]) && !empty($_POST["nom_caisse"])
    ) {

        // on recupere les donnees en les protegeant
        $nom_caisse = strip_tags($_POST["nom_caisse"]);
        $description = strip_tags($_POST["description"]);

        // on insere les donnees dans la table
        $sql = "INSERT INTO caisses (nom_caisse,description,associations_ID) 
        VALUES(:nom_caisse,:description, :associations_ID)";
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom_caisse", $nom_caisse);
        $requette->bindValue(":description", $description);
        $requette->bindValue(":associations_ID", $associations_ID);
        $requette->execute();
        $caisses = $requette->fetch();

        $_SESSION['message'] = "Caisse ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/caisses_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/caisses_ajouter.php");
        exit;
    }
}


require_once("../../dbconfig/connexion.php");
if (isset($_POST["modifier"])) {
    if (
        isset($_POST["caisses_ID"]) && !empty($_POST["caisses_ID"])
        && isset($_POST["nom_caisse"]) && !empty($_POST["nom_caisse"])
    ) {

        // on recupere les donnees en les protegeant
        $nom_caisse = $_POST["nom_caisse"];
        $description = $_POST["description"];
        $caisses_ID = $_POST["caisses_ID"];

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE caisses  SET nom_caisse=:nom_caisse,description=:description WHERE caisses_ID=:caisses_ID;';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom_caisse", $nom_caisse);
        $requette->bindValue(":description", $description);
        $requette->bindValue(":caisses_ID", $caisses_ID);
        $requette->execute();

        $_SESSION['message'] = "Caisse modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/caisses_liste.php");
        exit;
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/caisses_modifier.php");
        exit;
    }
}

?> 