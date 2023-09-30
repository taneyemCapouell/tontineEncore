
<?php
session_start();
$associations_ID = $_SESSION["user"]["associations_ID"];
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["cause"]) && !empty($_POST["cause"])
        && isset($_POST["montant"]) && !empty($_POST["montant"])
        && isset($_POST["delait"]) && !empty($_POST["delait"])
        && isset($_POST["statut"]) && !empty($_POST["statut"])
    ) {

        // on recupere les donnees en les protegeant
        $cause = strip_tags($_POST["cause"]);
        $montant = strip_tags($_POST["montant"]);
        $delait = strip_tags($_POST["delait"]);
        $statut = strip_tags($_POST["statut"]);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO sanctions (cause , montant, delait, statut,associations_ID) 
            VALUES(:cause , :montant, :delait, :statut, :associations_ID)";

        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":cause", $cause);
        $requette->bindValue(":montant", $montant);
        $requette->bindValue(":delait", $delait);
        $requette->bindValue(":statut", $statut);
        $requette->bindValue(":associations_ID", $associations_ID);

        // on execute la requette
        $requette->execute();
        $sesssion = $requette->fetch();

        $_SESSION['message'] = "Sanction ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/sanctions_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/sanctions_ajouter.php");
        exit;
    }
}

if (isset($_POST["modifier"])) {
    if (
        isset($_POST["cause"]) && !empty($_POST["cause"])
        && isset($_POST["montant"]) && !empty($_POST["montant"])
        && isset($_POST["delait"]) && !empty($_POST["delait"])
        && isset($_POST["statut"]) && !empty($_POST["statut"])
        && isset($_POST["sanctions_ID"]) && !empty($_POST["sanctions_ID"])
    ) {

        // on recupere les donnees en les protegeant
        $cause = $_POST["cause"];
        $montant = $_POST["montant"];
        $delait = $_POST["delait"];
        $statut = $_POST["statut"];
        $sanctions_ID = $_POST["sanctions_ID"];

        require("../../dbconfig/connexion.php");

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE sanctions SET cause=:cause,montant=:montant,delait=:delait,statut=:statut 
        WHERE sanctions_ID=:sanctions_ID';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":cause", $cause);
        $requette->bindValue(":montant", $montant);
        $requette->bindValue(":delait", $delait);
        $requette->bindValue(":statut", $statut);
        $requette->bindValue(":sanctions_ID", $sanctions_ID);
        $requette->execute();
        
        $_SESSION['message'] = "Sanction modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/sanctions_liste.php");
        exit;
        require("../../dbconfig/deconnexion.php");
    } else {
        // echo"capo2";exit;
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/sanctions_modifier.php");
        exit;
    }
}
?> 