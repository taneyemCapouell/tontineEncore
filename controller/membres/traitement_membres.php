
<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
$associations_ID = $_SESSION["user"]["associations_ID"];

if (isset($_POST["enregistrer"])) {
    if (
        isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["mail"]) && !empty($_POST["mail"])
        && isset($_POST["genre"]) && !empty($_POST["genre"])
        && isset($_POST["localisation"]) && !empty($_POST["localisation"])
        && isset($_POST["statu"]) && !empty($_POST["statu"])
    ) {

        // on recupere les donnees en les protegeant
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $telephone = strip_tags($_POST["telephone"]);
        $ville = strip_tags($_POST["ville"]);
        $mail = strip_tags($_POST["mail"]);
        $genre = strip_tags($_POST["genre"]);
        $localisation = strip_tags($_POST["localisation"]);
        $fond = strip_tags($_POST["fond"]);
        $date_nais = strip_tags($_POST["date_nais"]);
        $statu = strip_tags($_POST["statu"]);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO membres (nom,prenom,telephone,ville,email,genre,localisation,fond,date_nais,statu,associations_ID) 
        VALUES(:nom,:prenom,:telephone,:ville,:mail,:genre,:localisation,:fond,:date_nais,:statu,:associations_ID)";
        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":ville", $ville);
        $requette->bindValue(":mail", $mail);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":fond", $fond);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->bindValue(":statu", $statu);
        $requette->bindValue(":associations_ID", $associations_ID);
        // on execute la requette
        $requette->execute();
        // $membres = $requette->fetch();

        $_SESSION['message'] = "Membres ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/membres_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/membres_ajouter.php");
        exit;
    }
}


if (isset($_POST["modifier"])) {
    if (
        isset($_POST["membres_ID"]) && !empty($_POST["membres_ID"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["telephone"]) && !empty($_POST["telephone"])
        && isset($_POST["genre"]) && !empty($_POST["genre"])
        && isset($_POST["localisation"]) && !empty($_POST["localisation"])
        && isset($_POST["statu"]) && !empty($_POST["statu"])
    ) {

        // on recupere les donnees en les protegeant
        $membres_ID = $_POST["membres_ID"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $telephone = $_POST["telephone"];
        $ville = $_POST["ville"];
        $mail = $_POST["mail"];
        $genre = $_POST["genre"];
        $localisation = $_POST["localisation"];
        $fond = $_POST["fond"];
        $date_nais = $_POST["date_nais"];
        $statu = $_POST["statu"];

        $sql = 'UPDATE membres  SET nom=:nom,prenom=:prenom,email=:mail,telephone=:telephone,genre=:genre,ville=:ville,localisation=:localisation,
        fond=:fond,date_nais=:date_nais, statu=:statu WHERE membres_ID=:membres_ID';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":mail", $mail);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":ville", $ville);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":fond", $fond);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->bindValue(":statu", $statu);
        $requette->bindValue(":membres_ID", $membres_ID);
        $requette->execute();

        $_SESSION['message'] = "Membre modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/membres_liste.php");

    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/membres_modifier.php");
        exit;
    }
}


?> 