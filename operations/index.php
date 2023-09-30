<?php
    // on demare la session     
    session_start();
        
    // on se connecte a la base de donnees
    include_once("config.php");

    $sql = "SELECT * FROM  liste";

    // on prepare le requette
    $requette = $connexion -> prepare($sql);

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
    <title>Liste des produits</title>
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
                    <h1>Liste des produits</h1>
                    <thead class="thead-dark">
                        <th>Id</th>
                        <th>Produit</th>
                        <th>Nombre</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        // boucle sur la variable tableau
                            foreach($resultat as $produit){
                                ?>
                                <tr>
                                    <td><?= $produit["id"] ?></td>
                                    <td><?= $produit["produit"] ?></td>
                                    <td><?= $produit["nombre"] ?></td>
                                    <td><?= $produit["prix"] ?></td>
                                    <td>
                                        <a href="detail.php?id=<?= $produit["id"] ?>">Voir</a> 
                                        <a href="edit.php?id=<?= $produit["id"] ?>">Modifier</a>
                                        <a href="delete.php?id=<?= $produit["id"] ?>">Suprimer</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?> 
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>
</html>