<?php
    // on demare la session
    session_start();
    
    if($_POST){
        if(isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST["produit"]) && !empty($_POST["produit"])
        && isset($_POST["nombre"]) && !empty($_POST["nombre"])
        && isset($_POST["prix"]) && !empty($_POST["prix"])){

        // on se connecte a la base de donnees
        require_once("config.php");

            // on recupere les donnees en les protegeant
            $id = strip_tags($_POST["id"]);
            $produit = strip_tags($_POST["produit"]);
            $nombre = strip_tags($_POST["nombre"]);
            $prix = strip_tags($_POST["prix"]);

            // on insere les donnees dans la base de donnees
            $sql = "UPDATE liste  (produit = :produit , nombre = :nombre , prix = :prix) 
            WHERE(id = :id);";

            // on prepare la requette 
            $requette = $connexion -> prepare($sql);
 
            $requette -> bindValue(":id", $id , PDO::PARAM_INT);
            $requette -> bindValue(":produit", $produit , PDO::PARAM_STR);
            $requette -> bindValue(":nombre", $nombre , PDO::PARAM_INT);
            $requette -> bindValue(":prix", $prix , PDO::PARAM_INT);

            // on execute la requette
            $requette -> execute();

            $_SESSION["message"] = "Produit Modifier";
            header("location:index.php");

            //on se deconnecte a la base de donnees
            require_once("deconnexion.php");
        }else{
            $_SESSION["erreur"] = "formulaire incomplet";
        }
    }

    // on verifie si l'id existe et n'est pas vide dans l'url
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // on se connecte a la base deonnees
        require_once("config.php");
         
        // on netoie d'id envoyer
        $id = strip_tags($_GET["id"]);

        $sql = "SELECT * FROM liste WHERE id = :id;";

        // on prepare la requette 
        $requette  = $connexion -> prepare($sql);

        // on accroche les parametres
        $requette ->bindValue(':id' , $id , PDO::PARAM_INT);

        // on execute la requette 
        $requette ->execute();

        // on recupere le produit(resultat de la requette)
        $produit = $requette -> fetch();

        // on verifie si l'id existe 
        if(!$produit){
            $_SESSION['erreur'] = "Cet id n'existe pas ";
            header('location:index.php');
        }            

        $sql = "DELETE FROM liste WHERE id = :id;";

        // on prepare la requette 
        $requette  = $connexion -> prepare($sql);

        // on accroche les parametres
        $requette ->bindValue(':id' , $id , PDO::PARAM_INT);

        // on execute la requette 
        $requette ->execute();

        $_SESSION['erreur'] = "Produit supprimer ";
            header('location:index.php');

       
    } else{
        $_SESSION['erreur'] = "URL INVALIDE";
        header('location:index.php');
    } 


?> 
