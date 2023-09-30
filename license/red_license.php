<?php
    // on demare la session     
    session_start();
        
    // on se connecte a la base de donnees
    include_once("connexion.php");

    $sql = "SELECT * FROM  license";

    // on prepare le requette
    $requette = $bdd -> prepare($sql);

    // on execute la requette
    $requette -> execute();

    // on stoque le resultat dans un tableau associatif
    $resultat = $requette -> fetchAll(PDO::FETCH_ASSOC);

    // on se deconnecte a la base donnees
     require_once("deconnexion.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>Liste des licenses</title>
</head>
<body>
    <main class="container">
    <div class="row">
            <section class="col-md-12">
                <?php 
                    if(!empty($_SESSION['erreur'])){
                        echo'<div class="alert alert-danger" role="alert">
                        '.$_SESSION['erreur'].'
                        </div>';

                        $_SESSION['erreur'] = "";
                    }
                ?>

                <?php 
                    if(!empty($_SESSION['message'])){
                        echo'<div class="alert alert-success" role="alert">
                        '.$_SESSION['message'].'
                        </div>';

                        $_SESSION['message'] = "";
                    }
                ?>
                <table class="table table-bordered text-center table-striped ">
                    <h1>Liste des licenses</h1>
                    <thead class="">
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Durree de la license</th>
                         <th>Actions</th> 
                    </thead>
                    <tbody>
                        <?php 
                        // boucle sur la variable tableau
                            foreach($resultat as $license){
                                ?>
                                <tr>
                                    <td><?= $license["nom"] ?></td>
                                    <td><?= $license["prix"] ?></td>
                                    <td><?= $license["durree"] ?></td>

                                    <td>
                                        <a href="detail_license.php?id=<?= $license["license_ID"]?>">Voir</a> 
                                        <a href="update_license.php?id=<?= $license["license_ID"]?>">Modifier</a>
                                        <a href="delete.php?id=<?= $license["license_ID"]?>">Supprimer</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?> 
                    </tbody>
                </table>
                <a href="add_license.php" class="btn btn-primary">Ajouter une licence</a>
    </main>
</body>
</html>