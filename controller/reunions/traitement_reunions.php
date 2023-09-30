
<?php
session_start();
$associations_ID = $_SESSION["user"]["associations_ID"];
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["heure_debut"]) && !empty($_POST["heure_debut"])
        && isset($_POST["heure_fin"]) && !empty($_POST["heure_fin"])
        && isset($_POST["titre_reunion"]) && !empty($_POST["titre_reunion"])
    ) {

        // on recupere les donnees en les protegeant
        $heure_debut = strip_tags($_POST["heure_debut"]);
        $heure_fin = strip_tags($_POST["heure_fin"]);
        $titre_reunion = strip_tags($_POST["titre_reunion"]);
        $commentaire = strip_tags($_POST["commentaire"]);
        $localisation = strip_tags($_POST["localisation"]);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO reunions (heure_debut,heure_fin,localisation,titre_reunion,commentaire,date_reunion,associations_ID)
         VALUES(:heure_debut,:heure_fin,:localisation,:titre_reunion,:commentaire,:date_reunion,:associations_ID)";

        // on prepare la requette
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":heure_debut", $heure_debut);
        $requette->bindValue(":heure_fin", $heure_fin);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":titre_reunion", $titre_reunion);
        $requette->bindValue(":commentaire", $commentaire);
        $requette->bindValue(":date_reunion", date("Y-m-d"));
        $requette->bindValue(":associations_ID", $associations_ID);
        $requette->execute();
        // echo"capo";

        $_SESSION['message'] = "Reunion ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/reunions_liste.php");
        exit;
        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        // echo"desto";exit;
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/reunions_ajouter.php");
        exit;
    }
}
