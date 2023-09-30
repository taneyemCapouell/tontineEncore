<?php

session_start();
// on enregistre en base de donnees
require_once 'connexion.php';
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
            $_POST["role"],
            $_POST["genre"],
            $_POST["pass"],
            $_POST["date_nais"]
        ) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) &&
        !empty($_POST["mail"]) && !empty($_POST["telephone"]) && !empty($_POST["role"])
        && !empty($_POST["genre"]) && !empty($_POST["pass"]) && !empty($_POST["date_nais"])
    ) {

        
        // on recupere les donnees en les protegeants
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $mail = $_POST["mail"];
        $telephone = htmlspecialchars($_POST["telephone"]);
        $role = htmlspecialchars($_POST["role"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $date_nais = htmlspecialchars($_POST["date_nais"]);

        // on verifie si l'adresse email est vraiment sur la forme d'une adresse email
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            die("Adresse email incorrect");
        }

        $query = $bdd->prepare("SELECT * FROM users WHERE email=:mail;");
        $query->bindValue(":mail", $mail);
        $user = (int)$requette->fetchColumn();
        if ($user) {
            die("Cette adrresse email existe deja dans la table!! Essayer une autre");
        }

        if(strlen($_POST["pass"]) < 6){
            die("Entrer un mot de passe superieur a 5 caracteres");
        }

        if($_POST["pass"] != $_POST["confirmer"]){
            die("Veiller confirmer le mot de passe");
        }

        // on va hasher le mot de passe
        $mot_de_passe = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(users_ID, nom, prenom, email, telephone, role, genre, date_naissance, mot_de_passe)
                VALUES(NULL, :nom, :prenom, :mail,:telephone,:role, :genre, :date_nais, '$mot_de_passe')";

        $requette = $bdd->prepare($sql);
        $requette->bindValue(":nom", $nom);
        $requette->bindValue(":prenom", $prenom);
        $requette->bindValue(":mail", $mail);
        $requette->bindValue(":telephone", $telephone);
        $requette->bindValue(":role", $role);
        $requette->bindValue(":genre", $genre);
        $requette->bindValue(":date_nais", $date_nais);
        $requette->execute();
        // die("capo");exit;

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
            "role" => $role,
            "genre" => $genre,
            "date_naissance" => $date_nais,
            "mot_de_passe" => $mot_de_passe
        ];

        // on va rediriger l'utilisateur sur la page de profil
        header('location:landing.php');
    } else {
        die("le formulaire est incomplet");
        // $_SESSION["message"] = "formulaire incomplet veillez remplir tous les champs";            
    }
}
