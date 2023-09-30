
<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["nom_banque"]) && !empty($_POST["nom_banque"])
        && isset($_POST["montant_max"]) && !empty($_POST["montant_max"])
        && isset($_POST["montant_min"]) && !empty($_POST["montant_min"])
    ) {

        // on recupere les donnees en les protegeant
        $nom_banque = strip_tags($_POST["nom_banque"]);
        $montant_max = strip_tags($_POST["montant_max"]);
        $montant_min = strip_tags($_POST["montant_min"]);

        // on insere les donnees dans la table
        $sql = "INSERT INTO banques (nom_banque,montant_max,montant_min) VALUES(:nom_banque, :montant_max, :montant_min)";
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom_banque", $nom_banque);
        $requette->bindValue(":montant_max", $montant_max);
        $requette->bindValue(":montant_min", $montant_min);
        $requette->execute();
        $caisses = $requette->fetch();

        $_SESSION['message'] = "Banque ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/banques_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/banques_ajouter.php");
        exit;
    }
}


require_once("../../dbconfig/connexion.php");
if (isset($_POST["modifier"])) {
    if (
        isset($_POST["banques_ID"]) && !empty($_POST["banques_ID"])
        && isset($_POST["nom_banque"]) && !empty($_POST["nom_banque"])
        && isset($_POST["montant_max"]) && !empty($_POST["montant_max"])
        && isset($_POST["montant_min"]) && !empty($_POST["montant_min"])
    ) {

        // on recupere les donnees en les protegeant
        $nom_banque = strip_tags($_POST["nom_banque"]);
        $montant_max = strip_tags($_POST["montant_max"]);
        $montant_min = strip_tags($_POST["montant_min"]);
        $banques_ID = $_POST["banques_ID"];

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE banques SET nom_banque=:nom_banque, montant_max=:montant_max ,montant_min=:montant_min
         WHERE banques_ID=:banques_ID;';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom_banque", $nom_banque);
        $requette->bindValue(":montant_max", $montant_max);
        $requette->bindValue(":montant_min", $montant_min);
        $requette->bindValue(":banques_ID", $banques_ID);
        $requette->execute();

        $_SESSION['message'] = "Banque modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/banques_liste.php");
        exit;
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/banques_modifier.php");
        exit;
    }
}



?> 