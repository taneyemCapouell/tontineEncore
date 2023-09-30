<?php
    // on demare la session
    session_start();
    
    if($_POST){
        if(isset($_POST["license_ID"]) && !empty($_POST["license_ID"])
        && isset($_POST["nom_license"]) && !empty($_POST["nom_license"])
        && isset($_POST["prix_license"]) && !empty($_POST["prix_license"])
        && isset($_POST["durree"]) && !empty($_POST["durree"])){

        // on se connecte a la base de donnees
        require_once("connexion.php");

            // on recupere les donnees en les protegeant
            $license_ID = strip_tags($_POST["license_ID"]);
            $nom_license = strip_tags($_POST["nom_license"]);
            $prix_license = strip_tags($_POST["prix_license"]);
            $durree = strip_tags($_POST["durree"]);

            // on insere les donnees dans la base de donnees
            $sql = 'UPDATE license  SET nom = :nom_license , prix = :prix_license , 
            durree =:durree WHERE license_ID = :license_ID';

            // on prepare la requette 
            $requette = $bdd -> prepare($sql);
            
            $requette -> bindValue(":nom", $nom_license);
            $requette -> bindValue(":prix", $prix_license);
            $requette -> bindValue(":durree", $durree);
            $requette -> bindValue(":license_ID", $license_ID);
 
            // on execute la requette
            $requette -> execute();

            $_SESSION["message"] = "license Modifier";
            header("location:red_license.php");

            //on se deconnecte a la base de donnees
            require_once("deconnexion.php");
        }else{
            $_SESSION["erreur"] = "formulaire incomplet";
        }
    }

    // on verifie si l'id existe et n'est pas vide dans l'url
    if(isset($_GET["id"]) && !empty($_GET["id"]))
    {
        // on se connecte a la base deonnees
        require_once("connexion.php");
         
        // on netoie d'id envoyer
        $id = strip_tags($_GET["id"]);

        $sql = "SELECT * FROM license WHERE license_ID = :id;";

        // on prepare la requette 
        $requette  = $bdd -> prepare($sql);

        // on accroche les parametres
        $requette ->bindValue(':id' , $id , PDO::PARAM_INT);

        // on execute la requette 
        $requette ->execute();

        // on recupere le produit(resultat de la requette)
        $license = $requette -> fetch();

        // on verifie si l'id existe 
        if(!$license){
            $_SESSION['erreur'] = "Cet id n'existe pas ";
            header('location:red_license.php');
        }            
       
    } else{
        $_SESSION['erreur'] = "URL INVALIDE";
        header('location:red_license.php');
    } 
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <title>Modifier une license</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-md-6">
                <?php 
                    if(!empty($_SESSION['erreur'])){
                        echo'<div class="alert alert-danger" role="alert">
                        '.$_SESSION['erreur'].'
                        </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier une license</h1>
                <form method="post" class="form" action="">
                <div>
                        <div class="form-group">
                            <label for="nom_license">Nom :</label>
                            <input type="text" id="nom_license" name="nom_license" value='<?= $license["nom"] ?>' 
                            class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prix_license">Prix :</label>
                            <input type="number" id="prix_license" name="prix_license" value='<?= $license["prix"] ?>'
                             class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="durree">Durree de la licence :</label>
                            <input type="number" id="durree" name="durree" value='<?= $license["durree"] ?>'
                             class="form-control">
                        </div>

                        <div class="btn">
                            <input type="hidden" value="<?= $license["license_ID"] ?>" name="license_ID">
                            <button type="submit" class="btn-primary btn-block btn-lg">Envoyer</button>
                        </div>

                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>