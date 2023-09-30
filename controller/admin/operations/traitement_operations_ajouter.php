
<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
if ($_POST) {
    if (
        isset($_POST["retrait"]) && !empty($_POST["retrait"])
        && isset($_POST["montant_cotiser"]) && !empty($_POST["montant_cotiser"])
        && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["caisses_ID"]) && !empty($_POST["caisses_ID"])
    ) {

        // on recupere les donnees en les protegeant
        $retrait = strip_tags($_POST["retrait"]);
        $montant_cotiser = strip_tags($_POST["montant_cotiser"]);
        $caisses_ID = strip_tags($_POST["caisses_ID"]);

        // on insere les donnees dans la table
        $sql = "INSERT INTO operations (retrait,montant_en_caisse,caisses_ID) 
        VALUES(:retrait, :montant_cotiser,:caisses_ID)";
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":retrait", $retrait);
        $requette->bindValue(":montant_cotiser", $montant_cotiser);
        $requette->bindValue(":caisses_ID", $caisses_ID);
        $requette->execute();
        $caisses = $requette->fetch();

        $_SESSION['message'] = "Operation ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/operations_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/operations_ajouter.php");
        exit;
    }
}
?> 