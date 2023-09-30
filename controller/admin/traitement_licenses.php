<?php
    // on demare la session
    session_start();
    require_once("../../dbconfig/connexion.php");
    if (isset($_POST["enregistrer"])) {
        if(isset($_POST["nom_license"]) && !empty($_POST["nom_license"])
            && isset($_POST["prix_license"]) && !empty($_POST["prix_license"])
            && isset($_POST["durree"]) && !empty($_POST["durree"])){
            // on recupere les donnees en les protegeant
            $nom_license = strip_tags($_POST["nom_license"]);
            $prix_license = strip_tags($_POST["prix_license"]);
            $durree = strip_tags($_POST["durree"]);
            
            // on insere les donnees dans la base de donnees
            $sql = 'INSERT INTO license (nom , prix , durree) VALUES(:nom_license, :prix_license, :durree)';

            // on prepare la requette 
            $requette = $bdd -> prepare($sql);

            $requette -> bindValue(":nom_license", $_POST["nom_license"]);
            $requette -> bindValue(":prix_license", $_POST["prix_license"]);
            $requette -> bindValue(":durree", $_POST["durree"]);

            // on execute la requette
            $requette -> execute();
            $licence = $requette -> fetchALL();
            $_SESSION['message'] = "License ajouter";
            $_SESSION['status'] = "success";
            header("location:../../view/admin/license_liste.php");
            exit;

            //on se deconnecte a la base de donnees
            require_once("../../dbconfig/deconnexion.php");
        }else{
            $_SESSION['message'] = "Formulaire incomplet";
            $_SESSION['status'] = "danger";
            header("location:../../view/admin/license_ajouter.php");
            exit;
        } 
    }
    if (isset($_POST["modifier"])) {
        if (
            isset($_POST["license_ID"]) && !empty($_POST["license_ID"])
            && isset($_POST["nom_license"]) && !empty($_POST["nom_license"])
            && isset($_POST["prix_license"]) && !empty($_POST["prix_license"])
            && isset($_POST["durree"]) && !empty($_POST["durree"])
        ) {
    
            // on se connecte a la base de donnees
            require_once("../../dbconfig/connexion.php");
    
            // on recupere les donnees en les protegeant
            $nom_license = strip_tags($_POST["nom_license"]);
            $prix_license = strip_tags($_POST["prix_license"]);
            $durree = strip_tags($_POST["durree"]);
            $license_ID = strip_tags($_POST["license_ID"]);
    
            // on insere les donnees dans la base de donnees
            $sql = 'UPDATE license  SET nom=:nom_license , prix=:prix_license ,durree=:durree 
            WHERE license_ID=:license_ID;';
    
            // on prepare la requette 
            $requette = $bdd->prepare($sql);
    
            $requette->bindValue("nom_license", $nom_license);
            $requette->bindValue(":prix_license", $prix_license);
            $requette->bindValue(":durree", $durree);
            $requette->bindValue(":license_ID", $license_ID);
            $requette->execute();
    
            $_SESSION['message'] = 'License Modifier';
            $_SESSION['status'] = 'success';
            header("location:../../view/admin/license_liste.php");
            exit;
            require_once("../../dbconfig/deconnexion.php");
        } else {
            $_SESSION['message'] = 'Formulaire incomplet';
            $_SESSION['status'] = 'danger';
            header("location:../../view/admin/license_modifier.php");
            exit;
        }
    }
    ?>
