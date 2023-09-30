
<?php
session_start();
require_once('../../dbconfig/connexion.php');
if (isset($_POST["enregistrer"])) {
    if (
        isset(
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["mail"],
            $_POST["telephone"],
            $_POST["localisation"],
            $_POST["role"],
            $_POST["genre"],
            $_POST["pass"],
            $_POST["date_nais"],
            $_POST["confirmer"],
            $_POST["associations_ID"]
        ) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["telephone"])
        && !empty($_POST["localisation"]) && !empty($_POST["role"]) && !empty($_POST["genre"]) && !empty($_POST["date_nais"])
        && !empty($_POST["pass"]) && !empty($_POST["associations_ID"])
    ) {
        // on recupere les donnees en les protegeants
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $mail = $_POST["mail"];
        $telephone = htmlspecialchars($_POST["telephone"]);
        $localisation = htmlspecialchars($_POST["localisation"]);
        $role = htmlspecialchars($_POST["role"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $date_nais = htmlspecialchars($_POST["date_nais"]);
        $pass = $_POST["pass"];
        $confirmer = $_POST["confirmer"];
        $associations_ID = $_POST["associations_ID"];

        // on verifie si l'adresse email est vraiment sur la forme d'une adresse email
        if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Adresse email incorrect";
            $_SESSION['status'] = "danger";
            header("location:../../view/admin/users_ajouter.php");
            exit;
        }

        $query = $bdd->prepare("SELECT * FROM users WHERE email=:mail;");
        $query->bindValue(":mail", $mail);
        $query->execute();
        $user = (int)$query->fetchColumn();
        if ($user) {
            $_SESSION['message'] = "Cet adresse email existe deja!! Essayer une autre";
            $_SESSION['status'] = "danger";
            header("location:../../view/admin/users_ajouter.php");
            exit;
        }

        if (strlen($_POST["pass"]) < 6) {
            $_SESSION['message'] = "Entrer un mot de passe supperieur a 5 caracteres";
            $_SESSION['status'] = "danger";
            header("location:../../view/admin/users_ajouter.php");
            exit;
        }

        if ($_POST["pass"] != $_POST["confirmer"]) {
            $_SESSION['message'] = "Veiller confirmer le mot de passe";
            $_SESSION['status'] = "danger";
            header("location:../../view/admin/users_ajouter.php");
            exit();
        }

        // on va hasher le mot de passe
        $mot_de_passe = password_hash($_POST["pass"], PASSWORD_DEFAULT);

        // on insere les donnees dans la base de donnees
        $sql = "INSERT INTO users (nom, prenom, email,telephone,localisation, role, genre, mot_de_passe, date_nais,associations_ID) 
            VALUES(:nom,:prenom,:mail,:telephone,:localisation,:role,:genre,'$mot_de_passe',:date_nais,:associations_ID)";

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":mail", $_POST["mail"]);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":role", $role);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->bindValue(":associations_ID", $associations_ID);
        // on execute la requette
        $requette->execute();
        $users = $requette->fetch();

        $_SESSION['message'] = "Utilisateur ajouter";
        $_SESSION['status'] = "success";
        header("location:../../view/admin/users_liste.php");
        exit;

        //on se deconnecte a la base de donnees
        require("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = "Formulaire incomplet";
        $_SESSION['status'] = "danger";
        header("location:../../view/admin/users_ajouter.php");
        exit;
    }
}


if (isset($_POST["modifier"])) {
    if(isset($_POST["users_ID"]) && !empty($_POST["users_ID"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["prenom"]) && !empty($_POST["prenom"])
        && isset($_POST["mail"]) && !empty($_POST["mail"])
        && isset($_POST["telephone"]) && !empty($_POST["telephone"])
        && isset($_POST["localisation"]) && !empty($_POST["localisation"])
        && isset($_POST["role"]) && !empty($_POST["role"])
        && isset($_POST["genre"]) && !empty($_POST["genre"])
        && isset($_POST["date_nais"]) && !empty($_POST["date_nais"])
    ) {

        // on se connecte a la base de donnees
        require("../../dbconfig/connexion.php");

        // on recupere les donnees en les protegeant
        $users_ID = $_POST["users_ID"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"]; 
        $mail = $_POST["mail"];
        $telephone = $_POST["telephone"];
        $localisation = $_POST["localisation"];
        $role = $_POST["role"];
        $genre = $_POST["genre"];
        $date_nais = $_POST["date_nais"];

        $sql = 'UPDATE users  SET nom=:nom , prenom=:prenom ,email=:mail, telephone=:telephone,localisation=:localisation, 
        role=:role,genre=:genre,date_nais=:date_nais WHERE users_ID=:users_ID;';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":mail", $mail);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":role", $role);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->bindValue(":users_ID", $users_ID);
        $requette->execute();

        $_SESSION['message'] = "Utilisateur modifier";
        $_SESSION['status'] = "success";
        header("location:../../view/admin/users_liste.php");
        exit;
        require("../../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/admin/users_modifier.php");
        exit;
    }
}

?> 