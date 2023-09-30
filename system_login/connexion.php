<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./js/bootstrap.js">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php
        $serveur = 'localhost';
        $username = 'root';
        $password = '';
        
            //On essaie de se connecter
        try{
            $bdd = new PDO("mysql:host=$serveur;dbname=tontine", $username, $password);

            //On définit le mode d'erreur de PDO sur Exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Connexion réussie';
        }
        
        /*On capture les exceptions si une exception est lancée et on affiche
        *les informations relatives à celle-ci*/
        catch(PDOException $e){
            echo "Erreur de connexion : " . $e->getMessage();
        }
    ?>
</body>
</html>