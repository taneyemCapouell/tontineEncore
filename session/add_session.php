
<?php
    // on demare la session
    session_start();

    if($_POST){
        if(isset($_POST["titre"]) && !empty($_POST["titre"])
            && isset($_POST["date_debut"]) && !empty($_POST["date_debut"])
            && isset($_POST["date_fin"]) && !empty($_POST["date_fin"])
            && isset($_POST["type_bouffe"]) && !empty($_POST["type_bouffe"])
            && isset($_POST["durree_session"]) && !empty($_POST["durree_session"])){

            // on se connecte a la base de donnees
            require_once('connexion.php');

            // on recupere les donnees en les protegeant
            $titre = strip_tags($_POST["titre"]);
            $date_debut = strip_tags($_POST["date_debut"]);
            $date_fin = strip_tags($_POST["date_fin"]);
            $type_bouffe = strip_tags($_POST["type_bouffe"]);
            $durree_session = strip_tags($_POST["durree_session"]);

            // on insere les donnees dans la base de donnees
            $sql = "INSERT INTO sessionss (titre , date_debut , date_fin ,  type_bouffe, durree) 
            VALUES(:titre , :date_debut , :date_fin, :type_bouffe, :durree_session)";

            // on prepare la requette 
            $requette = $bdd -> prepare($sql);

            $requette -> bindValue(":titre", $_POST["titre"]);
            $requette -> bindValue(":date_debut", $_POST["date_debut"]);
            $requette -> bindValue(":date_fin", $_POST["date_fin"]);
            $requette -> bindValue(":type_bouffe", $_POST["type_bouffe"]);
            $requette -> bindValue(":durree_session", $_POST["durree_session"]);

            // on execute la requette
            $requette -> execute();

            $_SESSION['message'] = "Session ajouter";
            header("location:red_session.php");          

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
    <title>Ajouter  une session</title>
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
                <h1>Ajouter une session</h1>
                <form method="POST" action="" class="form">
                    <div>
                        
                        <div class="form-group">
                            <label for="titre">Titre de la session :</label>
                            <input type="text" id="titre" name="titre" class="form-control">
                        </div>

                        <div class="debut">
                            <label for="date_debut">Date de debut :</label>
                            <input type="date" id="date_debut" name="date_debut" class="form-control">
                        </div>

                        <div class="fin">
                            <label for="date_fin">Date de fin :</label>
                            <input type="date" id="nombre" name="date_fin" class="form-control">
                        </div>

                        <div class="fin">
                            <label for="type_bouffe">Type bouffe : </label>
                            <input type="text" id="type_bouffe" name="type_bouffe" class="form-control">
                        </div>

                        <div class="fin"> 
                            <label for="durree_session">Durree de la session : </label>
                            <input type="number" id="durree_session" name="durree_session" class="form-control">
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