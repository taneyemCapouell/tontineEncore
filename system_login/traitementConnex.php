<!-- <?php
            // on demare la session 

            session_start();
    // on verifie si le formulaire a ete bien envoyer
    if(isset($_POST)){
        // le formulaire a ete bien envoyer

        // on verifie si tous les champs sont remplis
        if(isset($_POST["mail"], $_POST["pass"]) && !empty($_POST["mail"]) && !empty($_POST["pass"]))
        {
            // le formulaire est complet 
            
            // on recupere les donnees en les protegeants
            $email= htmlspecialchars($_POST["mail"]);
            $password= $_POST["pass"];
            
            // verifie que l'email est sous la forme d'une adresse email
            if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
               die("ce n'est pas un email");
            }

            // on se connecte a la base de donnees
            require_once('connexion.php');


            $sql = "SELECT * FROM users WHERE email = :mail";

            $requette = $bdd -> prepare($sql);

            $requette -> bindValue(":mail", $email);
            
            $requette -> execute();
           
            $users = $requette -> fetch();
            if(!$users){
                die("Utilisateur introuvable");
            }
            
            // si l'utilisateur et le mot de passe sont corrects , on va connecter l'utilisateur 
            //  on va stoker dans $_SESSION les infos de l'utilisateur
            
            $_SESSION["users"] = [
                "users_ID" => $users["users_ID"],
                "nom" => $users["nom"],
                "prenom" => $users["prenom"],
                "email" => $users["mail"],
                "telephone" => $users["telephone"],
                "role" => $users["role"],
                "genre" => $users["genre"],
                "mot_de_passe" => $users["pass"]
            ];

            // si on a un user on peut verifier le mot de passe 
            if(!password_verify($_POST["pass"], $users["mot_de_passe"])){
                die("L'utilisateur et ou le mot de passe incorrecte");
            }
            // on va rediriger l'utilisateur sur la page de profil
            header("location:landing.php");

        }else{
            die("veillez remplir tout les champs");
        }
    }            
?> -->