<?php
session_start();
require_once('../dbconfig/connexion.php');
// on verifie si le formulaire a ete bien envoyer
if (!empty($_POST)) {
    //le formulaire a ete bien envoyer

    // on verifie si tous les champs sont remplis
    if (
        isset(
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["mail"],
            $_POST["telephone"],
            $_POST["localisation"],
            $_POST["role"],
            $_POST["genre"],
            $_POST["date_nais"],
            $_POST["pass"],
            $_POST["confirmer"],
            $_POST["associations_ID"]
        ) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["mail"]) && !empty($_POST["telephone"])
        && !empty($_POST["localisation"]) && !empty($_POST["role"]) && !empty($_POST["genre"])
        && !empty($_POST["date_nais"]) && !empty($_POST["pass"]) && !empty($_POST["confirmer"])
    ) {
        // on recupere les donnees en les protegeants
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $mail = $_POST["mail"];
        $telephone = htmlspecialchars($_POST["telephone"]);
        $localisation = htmlspecialchars($_POST["localisation"]);
        $role = htmlspecialchars($_POST["role"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $date_nais = $_POST["date_nais"];
        $pass = $_POST["pass"];
        $confirmer = $_POST["confirmer"];
        $associations_ID = $_POST["associations_ID"];


        // on verifie si l'adresse email est vraiment sur la forme d'une adresse email
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Adresse email incorrect";
            $_SESSION['status'] = "danger";
            header("location:../view/login/inscription.php");
            exit;
        }

        $requette = $bdd->prepare("SELECT * FROM users WHERE email=:mail;");
        $requette->bindValue(":mail", $mail);
        $requette->execute();
        $user = (int)$requette->fetchColumn();
        if ($user) {
            $_SESSION['message'] = "Cette adresse email existe deja dans la table!! Essayer une autre";
            $_SESSION['status'] = "danger";
            header("location:../view/login/inscription.php");
            exit;
        }

        if (strlen($_POST["pass"]) < 6) {
            $_SESSION['message'] = "Entrer un mot de passe superieur a 5 caracteres";
            $_SESSION['status'] = "danger";
            header("location:../view/login/inscription.php");
            exit;
        }

        if ($_POST["pass"] != $_POST["confirmer"]) {
            $_SESSION['message'] = "Veiller confirmer le mot de passe";
            $_SESSION['status'] = "danger";
            header("location:../view/login/inscription.php");
            exit;
        }

        // on va hasher le mot de passe
        $mot_de_passe = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nom, prenom, email, telephone,localisation, role, genre, date_nais, mot_de_passe,associations_ID)
                VALUES(:nom, :prenom, :mail,:telephone,:localisation,:role, :genre, :date_nais,'$mot_de_passe',:associations_ID)";

        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":mail", $mail);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":role", $role);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->bindValue(":associations_ID", $associations_ID);
        $requette->execute();
        // on recupere d'id de l'utilisateur
        $users_ID = $bdd->lastInsertId();
        $users = $requette->fetchALL();

        //  on va stoker dans $_SESSION les infos de l'utilisateur
        $_SESSION["users"] = [
            "users_ID" => $users_ID,
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $mail,
            "telephone" => $telephone,
            "adresse" => $localisation,
            "role" => $role,
            "genre" => $genre,
            "date_nais" => $date_nais,
            "mot_de_passe" => $mot_de_passe,
            "associations_ID" => $associations_ID
        ];
        // on va rediriger l'utilisateur sur la page de profil
        $_SESSION['message'] = "Inscription reussie";
        $_SESSION['status'] = "success";
        header("location:../view/index.php");
        // echo("capo"); exit;
        exit;
    } else {
        $_SESSION['message'] = "Formulaire incomplet veillez remplir tous les champs";
        $_SESSION['status'] = "danger";
        header("location:../view/login/inscription.php");
        exit;
    }
}
