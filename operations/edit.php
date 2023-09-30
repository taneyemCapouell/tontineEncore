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
            $sql = "UPDATE liste  SET produit=:produit , nombre=:nombre , prix=:prix
            WHERE id = :id;";

            // on prepare la requette 
            $requette = $connexion -> prepare($sql);
            
            $requette -> bindValue(":id", $id );
            $requette -> bindValue(":produit", $produit );
            $requette -> bindValue(":nombre", $nombre );
            $requette -> bindValue(":prix", $prix );

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
       
    } else{
        $_SESSION['erreur'] = "URL INVALIDE";
        header('location:index.php');
    } 
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>Modifier un prodiut</title>
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
                <h1>Modifier un produit</h1>
                <form method="post" class="form" action="">
                    <div>
                        <div class="form-group">
                            <label for="produit">Produit :</label>
                            <input type="text" id="produit" name="produit" class="form-control" 
                            value="<?= $produit["produit"] ?>">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre :</label>
                            <input type="number" id="nombre" name="nombre" class="form-control" class="form-control"
                            value="<?= $produit["nombre"] ?>">
                        </div>

                        <div class="form-group">
                            <label for="prix">Prix :</label>
                            <input type="number" id="prix" name="prix" class="form-control" value="<?= $produit["prix"] ?>">
                        </div>

                        <div class="btn">
                            <input type="hidden" value="<?= $produit["id"] ?>" name="id">
                            <button class="btn btn-primary">Modifier</button>
                        </div>

                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>