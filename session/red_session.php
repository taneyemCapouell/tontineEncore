<?php
    // on demare la session     
    session_start();
        
    // on se connecte a la base de donnees
    include_once("connexion.php");

    $sql = "SELECT * FROM  sessionss";

    // on prepare le requette
    $requette = $bdd -> prepare($sql);

    // on execute la requette
    $requette -> execute();

    // on stoque le resultat dans un tableau associatif
    $result = $requette -> fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
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
    <title>Liste des sessions</title>
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
                    <h1>Liste des sessions</h1>
                    <thead>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                        <th>Type bouffe</th>
                        <th>Durree de la session</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        // boucle sur la variable tableau
                            foreach($result as $session){
                                ?>
                                <tr>
                                    <td><?= $session["sessions_ID"] ?></td>
                                    <td><?= $session["titre"] ?></td>
                                    <td><?= $session["date_debut"] ?></td>
                                    <td><?= $session["date_fin"] ?></td>
                                    <td><?= $session["type_bouffe"] ?></td>
                                    <td><?= $session["durree"] ?></td>
                                    <td>
                                        <a href="detail_session.php?id=<?= $session["sessions_ID"] ?>">Voir</a> 
                                        <!-- <a href="edit.php?id=<?= $session["id"] ?>">Modifier</a>
                                        <a href="delete.php?id=<?= $session["id"] ?>">Suprimer</a> -->
                                    </td>
                                </tr>
                                <?php
                            }
                        ?> 
                    </tbody>
                </table>
                <a href="add_session.php" class="btn btn-primary">Ajouter une session</a>
            </section>
        </div>
    </main>
</body>
</html>