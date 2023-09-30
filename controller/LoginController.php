!
<?php
session_start();
require_once('../dbconfig/connexion.php');

if (isset($_POST)) {
    // le formulaire a ete bien envoyer

    // on verifie si tous les champs sont remplis
    if (!isset($_POST["mail"], $_POST["pass"]) || empty($_POST["mail"]) || empty($_POST["pass"])) {
        $_SESSION['message'] = "veillez remplir tout les champs";
        $_SESSION['status'] = "danger";
        header("location:../view/login/login.php");
        exit;
    }
    // on recupere les donnees en les protegeants
    $email = $_POST["mail"];
    $password = $_POST["pass"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Ce n'est pas un email";
        $_SESSION['status'] = "danger";
        header("location:../view/login/login.php");
        exit;
    }
    $sql = "SELECT * FROM users WHERE email = :mail";

    $requette = $bdd->prepare($sql);

    $requette->bindValue(":mail", $_POST["mail"]);

    $requette->execute();
    $user = $requette->fetch();

    if (!$user) {

        $_SESSION['message'] = "Utilisateur introuvable";
        $_SESSION['status'] = "danger";
        header("location:../view/login/login.php");
        exit;
    }

    // si on a un user on peut verifier le mot de passe 
    if (!password_verify($_POST["pass"], $user["mot_de_passe"])) {
        $_SESSION['message'] = "Utilisateur et ou mot de passe incorrect";
        $_SESSION['status'] = "danger";
        header("location:../view/login/login.php");
        exit;
    }

    if (!$user["associations_ID"]) {
        $_SESSION['message'] = "Vous devez appartenir a une association pour acceder a cette partir.";
        $_SESSION['status'] = "danger";
        header("location:../view/login/login.php");
        exit;    
    }
    // si l'utilisateur et le mot de passe sont corrects , on va connecter l'utilisateur 
    //  on va stoker dans $_SESSION les infos de l'utilisateur

    $_SESSION["user"] = [
        "users_ID" => $user["users_ID"],
        "nom" => $user["nom"],
        "prenom" => $user["prenom"],
        "email" => $user["email"],
        "telephone" => $user["telephone"],
        "localisation" => $user["localisation"],
        "role" => $user["role"],
        "genre" => $user["genre"],
        "date_nais" => $user["date_nais"],
        "mot_de_passe" => $user["mot_de_passe"],
        "associations_ID" => $user["associations_ID"]
    ];

    $sql = "SELECT * FROM associations WHERE associations_ID = :associations_ID";
    $requette = $bdd->prepare($sql);
    $requette->bindValue(":associations_ID", $user["associations_ID"]);
    $requette->execute();
    $associations = $requette->fetch();
    $_SESSION["nom"] = $associations["nom"];
    // die($_SESSION["nom"]);

    // on va rediriger l'utilisateur sur la page de profil
    $_SESSION['message'] = "Connexion reussie";
    $_SESSION['status'] = "success";
    header("location:../view/index.php");
    exit;
}
