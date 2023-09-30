<?php
    // on demare la session
    session_start();

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
    <title>Details du produit</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-md-12">
                <h1>Detail du produit</h1>
                <p>Id :<?= $produit["id"] ?></p>
                <p>Produit :<?= $produit["produit"] ?></p>
                <p>Nombre :<?= $produit["nombre"] ?></p>
                <p>Prix :<?= $produit["prix"] ?></p>
                <p>
                    <a class="btn btn-primary" href="index.php?id=<?=  $produit["id"] ?>">Retour</a>
                    <a class="btn btn-primary" href="edit.php?id=<?=  $produit["id"] ?>">Modifier</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>