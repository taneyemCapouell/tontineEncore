<?php
require_once("connexion.php");
        // on se connecte a la base deonnees
        require_once("connexion.php");
        
        $sql = 'SELECT * FROM sessionss WHERE sessions_ID = '.$_GET["id"];

        // on prepare la requette 
        $requette  =  $bdd -> prepare($sql);

        // on execute la requette 
        $requette -> execute();

        // on recupere le produit(resultat de la requette)
        $session = $requette -> fetch();

        // on verifie si l'id existe 
        if(!$session){
            $_SESSION['erreur'] = 'Cet id existe pas';
            header('location:red_session.php');
        } 
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>Details de la session</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-md-12">
                <h1>Detail de la session</h1>
                <p>ID :<?= $session["sessions_ID"] ?></p>
                <p>Titre de la session :<?= $session["titre"] ?></p>
                <p>Date de debut :<?= $session["date_debut"] ?></p>
                <p>Date de fin :<?= $session["date_fin"] ?></p>
                <p>Durree de la session :<?= $session["durree"] ?></p>
                <p>Type de bouffe :<?= $session["type_bouffe"] ?></p>
                <p>
                    <a class="btn btn-primary" href="red_session.php?id=<?=  $session["sessions_ID"]?>">Retour</a>
                    <a class="btn btn-primary" href=".php?id=<?=  $session["sessions_ID"] ?>">Modifier</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>