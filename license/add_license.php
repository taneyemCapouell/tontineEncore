<?php
    // on demare la session
    session_start();

    if($_POST){
        if(isset($_POST["nom_license"]) && !empty($_POST["nom_license"])
            && isset($_POST["prix_license"]) && !empty($_POST["prix_license"])
            && isset($_POST["durree"]) && !empty($_POST["durree"])){

            // on se connecte a la base de donnees
            require_once("connexion.php");

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

            $_SESSION['message'] = 'License ajouter';
            header('location:red_license.php');

            //on se deconnecte a la base de donnees
            require_once("deconnexion.php");
        }else{
            $_SESSION['erreur'] = 'formulaire incomplet';
        } 
    }

?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Ajouter une licence</title>
    <link rel="stylesheet" href="script.js">
</head>
<body>
    <main class="container">
    <div class="row">
            <section class="col-md-6 col-offset-3">
                <?php 
                    if(!empty($_SESSION['erreur'])){
                        echo'<div class="alert alert-danger" role="alert">
                        '.$_SESSION['erreur'].'
                        </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>  
                <h1>Ajouter une license</h1>
                <form method="POST">
                    <div>
                        <div class="form-group">
                            <label for="nom_license">Nom :</label>
                            <input type="text" id="nom_license" name="nom_license" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prix_license">Prix :</label>
                            <input type="number" id="prix_license" name="prix_license" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="durree">Durree de la licence :</label>
                            <input type="number" id="durree" name="durree" class="form-control">
                        </div>

                        <div class="btn">
                            <button type="submit" class="btn-primary btn-block btn-lg">Envoyer</button>
                        </div>

                    </div>
                </form>
                </section>
        </div>
    </main>
</body>
</html>