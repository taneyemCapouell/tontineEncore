<?php
    // on demare la session
        session_start();

    // permet de supprimer une variable
    unset($_SESSION["user"]);

    header("location: connexion.php");
?>