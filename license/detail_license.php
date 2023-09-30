<?php
    // on demare la session
    session_start();

    // on se connecte a la base deonnees
    require_once('connexion.php');

        $sql = 'SELECT * FROM license WHERE license_ID = '.$_GET["id"];

        // on prepare la requette
        $requette = $bdd -> prepare($sql);

        // on execute la requette 
        $requette -> execute(); 

        // on recupere la licence(resultat de la requette)
        $license = $requette -> fetch();       

        if(!$license){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('location:red_license.php');
        }
?> 
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Details de la license</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-md-12">

                <h1>Detail sur la license</h1>
                <p>ID :<?= $license["license_ID"] ?></p>
                <p>Nom :<?= $license["nom"] ?></p>
                <p>Prix :<?= $license["prix"] ?></p> 
                <p>Durree de la license :<?= $license["durree"] ?></p>
                <p>
                    <a class="btn btn-primary" href="red_license.php?id=<?= $license["license_ID"] ?>">Retour</a>
                    <a class="btn btn-primary" href="update_license.php?id=<?= $license["license_ID"] ?>">Modifier</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>