<?php
    // on demare la session
    session_start();

    if($_POST){
        if(isset($_POST["titre"]) && !empty($_POST["titre"])
            && isset($_POST["date_debut"]) && !empty($_POST["date_debut"])
            && isset($_POST["date_fin"]) && !empty($_POST["date_fin"])
            && isset($_POST["type_bouffe"]) && !empty($_POST["type_bouffe"])){

            // on se connecte a la base de donnees
            require_once('connexion.php');

            // on recupere les donnees en les protegeant
            $titre = strip_tags($_POST["titre"]);
            $date_debut = strip_tags($_POST["date_debut"]);
            $date_fin = strip_tags($_POST["date_fin"]);
            $type_bouffe = strip_tags($_POST["type_bouffe"]);

            // on insere les donnees dans la base de donnees
            $sql = "INSERT INTO sessionss (titre , date_debut , date_fin ,  type_bouffe) 
            VALUES(:titre , :date_debut , :date_fin, :type_bouffe)";

            // on prepare la requette 
            $requette = $bdd -> prepare($sql);

            $requette -> bindValue(":titre", $_POST["titre"]);
            $requette -> bindValue(":date_debut", $_POST["date_debut"]);
            $requette -> bindValue(":date_fin", $_POST["date_fin"]);
            $requette -> bindValue(":type_bouffe", $_POST["type_bouffe"]);

            // on execute la requette
            $requette -> execute();
            echo("session ajouter");
           
            //on se deconnecte a la base de donnees
            require_once("deconnexion.php");
        }else{
            echo("formulaire incomplet");
        } 
    }

?> 