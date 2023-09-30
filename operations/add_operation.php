<?php
    // on demare la session
    session_start();

    if($_POST){
        if(isset($_POST["produit"]) && !empty($_POST["produit"])
        && isset($_POST["nombre"]) && !empty($_POST["nombre"])
        && isset($_POST["prix"]) && !empty($_POST["prix"])){

        // on se connecte a la base de donnees
        require_once("config.php");

            // on recupere les donnees en les protegeant
            $produit = strip_tags($_POST["produit"]);
            $nombre = strip_tags($_POST["nombre"]);
            $prix = strip_tags($_POST["prix"]);

            // on insere les donnees dans la base de donnees
            $sql = "INSERT INTO liste (produit , nombre , prix) VALUES(:produit , :nombre , :prix)";

            // on prepare la requette 
            $requette = $connexion -> prepare($sql);

            $requette -> bindValue(":produit", $produit , PDO::PARAM_STR);
            $requette -> bindValue(":nombre", $nombre , PDO::PARAM_STR);
            $requette -> bindValue(":prix", $prix , PDO::PARAM_INT);

            // on execute la requette
            $requette -> execute();

            $_SESSION['message'] = "Produit ajouter";
            header("location:index.php");

            //on se deconnecte a la base de donnees
            require_once("deconnexion.php");
        }else{
            $_SESSION['erreur'] = "formulaire incomplet";
        }
    }

?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>Ajouter un prodiut</title>
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
                <h1>Ajouter un produit</h1>
                <form method="post" class="form" action="">
                    <div>
                        <div class="form-group">
                            <label for="produit">Produit :</label>
                            <input type="text" id="produit" name="produit" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre :</label>
                            <input type="number" id="nombre" name="nombre" class="form-control class="form-control>
                        </div>

                        <div class="form-group">
                            <label for="prix">Prix :</label>
                            <input type="number" id="prix" name="prix" class="form-control">
                        </div>

                        <div class="btn">
                            <button>Envoyer</button>
                        </div>

                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>