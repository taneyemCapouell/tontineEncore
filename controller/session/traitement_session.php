
<?php
session_start();
// on se connecte a la base de donnees
require_once('../../dbconfig/connexion.php');
$associations_ID = $_SESSION["user"]["associations_ID"];

if (isset($_POST["enregistrer"])) {

    // var_dump($_POST);
    if (
        isset($_POST["titre"]) && !empty($_POST["titre"])

    ) {

        // on recupere les donnees en les protegeant
        $titre = strip_tags($_POST["titre"]);
        $date_debut = strip_tags($_POST["date_debut"]);
        $date_fin = strip_tags($_POST["date_fin"]);
        $type_bouffe = strip_tags($_POST["type_bouffe"]);
        $durree_session = strip_tags($_POST["durree_session"]);
        $nb_bouffer = strip_tags($_POST["nb_bouffer"]);
        // $membres_ID = strip_tags($_POST["membres_ID"]);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO sessionss (titre , date_debut, date_fin, type_bouffe, durree, associations_ID, nb_bouffer) 
        VALUES(:titre, :date_debut, :date_fin, :type_bouffe, :durree_session, :associations_ID,:nb_bouffer)";
        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":titre", $titre);
        $requette->bindValue(":date_debut", $date_debut);
        $requette->bindValue(":date_fin", $date_fin);
        $requette->bindValue(":type_bouffe", $type_bouffe);
        $requette->bindValue(":durree_session", $durree_session);
        $requette->bindValue(":associations_ID", $associations_ID);
        $requette->bindValue(":nb_bouffer", $nb_bouffer);

        // on execute la requette
        $requette->execute();
        $session_ID = $bdd->lastInsertId();
        $_SESSION["session_ID"] = $bdd->lastInsertId();
        $montant = $_POST["montant"] = $bdd->lastInsertId();

        foreach ($_POST["membres_ID"] as $key => $membres) {
            // on insere les donnees dans la base de donnees
            $sql = "INSERT INTO contenir (montant_a_cotiser,membres_ID,sessionss_ID) 
        VALUES(:montant, :membre, :session_ID)";
            // on prepare la requette 
            $requette = $bdd->prepare($sql);
            $requette->bindValue(":montant", $montant[$key]);
            $requette->bindValue(":membre", $membres);
            $requette->bindValue(":session_ID", $session_ID);
            // on execute la requette
            $requette->execute();
        }
        // $_SESSION["montant"] = $sessionss['nb_bouffer'];
        $_SESSION['message'] = "Session ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/session_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require_once("deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet , veillez remplir tout les champs.";
        $_SESSION['status'] = "danger";
        header("location:../../view/session_ajouter.php");
        exit;
    }
}

if (isset($_POST["modifier"])) {
    if (
        isset($_POST["sessionss_ID"]) && !empty($_POST["sessionss_ID"])
        && isset($_POST["titre"]) && !empty($_POST["titre"])
        && isset($_POST["date_debut"]) && !empty($_POST["date_debut"])
        && isset($_POST["date_fin"]) && !empty($_POST["date_fin"])
        && isset($_POST["type_bouffe"]) && !empty($_POST["type_bouffe"])
        && isset($_POST["durree_session"]) && !empty($_POST["durree_session"])
    ) {

        // on recupere les donnees en les protegeant
        $titre = $_POST["titre"];
        $date_debut = $_POST["date_debut"];
        $date_fin = $_POST["date_fin"];
        $type_bouffe = $_POST["type_bouffe"];
        $durree_session = $_POST["durree_session"];
        $sessionss_ID = $_POST["sessionss_ID"];

        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE sessionss  SET titre=:titre, date_debut=:date_debut ,date_fin=:date_fin,type_bouffe=:type_bouffe,
        durree=:durree_session WHERE sessionss_ID=:sessionss_ID';
        // echo"capo";exit();

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":titre", $titre);
        $requette->bindValue(":date_debut", $date_debut);
        $requette->bindValue(":date_fin", $date_fin);
        $requette->bindValue(":type_bouffe", $type_bouffe);
        $requette->bindValue(":durree_session", $durree_session);
        $requette->bindValue(":sessionss_ID", $sessionss_ID);
        $requette->execute();


        $_SESSION['message'] = "Session modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/session_liste.php");
        exit;
        require("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/session_modifier.php");
        exit;
    }
}

if (isset($_POST["supprimer"])) {
    // on verifie si l'id existe et n'est pas vide dans l'url
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        // on se connecte a la base donnees
        require("../../dbconfig/connexion.php");

        // on netoie d'id envoyer
        $id = strip_tags($_GET["id"]);

        $sql = "SELECT * FROM sessionss WHERE sessionss_ID=:sessionss_ID;";

        // on prepare la requette 
        $requette  = $bdd->prepare($sql);

        // on accroche les parametres
        $requette->bindValue(':sessionss_ID', $id, PDO::PARAM_INT);

        // on execute la requette 
        $requette->execute();
        $sessions = $requette->fetch();

        // on verifie si l'id existe 
        if (!$sessions) {
            $_SESSION['message'] = "Cet id n'existe pas";
            $_SESSION['status'] = "danger";
            header("location:../../view/session_liste.php");
            exit;
        }

        $sql = "DELETE FROM sessionss WHERE sessionss_ID=:sessionss_ID;";

        // on prepare la requette 
        $requette  = $bdd->prepare($sql);

        // on accroche les parametres
        $requette->bindValue(':sessionss_ID', $id, PDO::PARAM_INT);

        // on execute la requette 
        $requette->execute();
        $_SESSION['message'] = "Session supprimer";
        $_SESSION['status'] = "success";
        header("location:../../view/session_liste.php");
        exit;
    } else {
        $_SESSION['message'] = "URL INVALIDE";
        $_SESSION['status'] = "danger";
        header("location:../../view/session_liste.php");
    }
}
?> 