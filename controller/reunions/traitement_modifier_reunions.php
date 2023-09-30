
<?php

// var_dump($_POST);
require("../dbconfig/connexion.php");
if (isset($_POST["modifier"])) {

    if (
        isset($_POST["reunions_ID"]) && !empty($_POST["reunions_ID"])
        && isset($_POST["heure_debut"]) && !empty($_POST["heure_debut"])
        && isset($_POST["heure_fin"]) && !empty($_POST["heure_fin"])
        && isset($_POST["date_reunion"]) && !empty($_POST["date_reunion"])
        && isset($_POST["titre_reunion"]) && !empty($_POST["titre_reunion"])
        && isset($_POST["commentaire"]) && !empty($_POST["commentaire"])
        && isset($_POST["beneficiaire1"]) && !empty($_POST["beneficiaire1"])
        && isset($_POST["localisation"]) && !empty($_POST["localisation"])
    ) {

        // on se connecte a la base de donnees


        // on recupere les donnees en les protegeants
        $heure_debut = $_POST["heure_debut"];
        $heure_fin = $_POST["heure_fin"];
        $date_reunion = $_POST["date_reunion"];
        $titre_reunion = $_POST["titre_reunion"];
        $commentaire = $_POST["commentaire"];
        $localisation = $_POST["localisation"];
        $reunions_ID = $_POST["reunions_ID"];
        $beneficiaire1 = $_POST["beneficiaire1"];
        $beneficiaire2 = $_POST["beneficiaire2"];
        $montant1 = $_POST["montant1"];
        $montant2 = $_POST["montant2"];


        $sql = 'UPDATE reunions SET heure_debut=:heure_debut,heure_fin=:heure_fin,titre_reunion=:titre_reunion,localisation=:localisation,
        contenir_ID=:beneficiaire1,contenir_ID2=:beneficiaire2,date_reunion=:date_reunion,commentaire=:commentaire
        WHERE reunions_ID=:reunions_ID;';

        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":heure_debut", $heure_debut);
        $requette->bindValue(":heure_fin", $heure_fin);
        $requette->bindValue(":titre_reunion", $titre_reunion);
        $requette->bindValue(":localisation", $localisation);
        $requette->bindValue(":beneficiaire1", $beneficiaire1);
        $requette->bindValue(":beneficiaire2", $beneficiaire2);
        $requette->bindValue(":date_reunion", $date_reunion);
        $requette->bindValue(":commentaire", $commentaire);
        $requette->bindValue(":reunions_ID", $reunions_ID);
        $requette->execute();


        $sql = 'UPDATE contenir SET montant_bouffer=:montant1,bouffer_le=:bouffer_le WHERE contenir_ID=:contenir_ID;';
        // on prepare la requette 
        $requette = $bdd->prepare($sql);

        $requette->bindValue(":montant1", $montant1);
        $requette->bindValue(":bouffer_le", date("Y-m-d"));
        $requette->bindValue(":contenir_ID", $beneficiaire1);
        $requette->execute();

        if ($montant2) {
            $sql = 'UPDATE contenir SET montant_bouffer=:montant1,bouffer_le=:bouffer_le WHERE contenir_ID=:contenir_ID;';
            // on prepare la requette 
            $requette = $bdd->prepare($sql);

            $requette->bindValue(":montant1", $montant2);
            $requette->bindValue(":bouffer_le", date("Y-m-d"));
            $requette->bindValue(":contenir_ID", $beneficiaire2);
            $requette->execute();
        }
        ?>
            <script>
                // window.location.reload();
            </script>
        <?php


    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:../../view/reunions_modifier.php");
        exit;
    }
}


if (isset($_POST["cotisation"])) {
    $reunions_ID = $_POST["reunions_ID"];
    $montant_cotiser = $_POST["montant_cotiser"];
    $sql = 'DELETE FROM cotiser where reunions_ID=:reunions_ID';
    $requette = $bdd->prepare($sql);
    $requette->bindValue(":reunions_ID", $reunions_ID);
    $requette->execute();

    foreach ($montant_cotiser as $key => $values) {
        $sql = 'INSERT into cotiser (date,montant,contenir_ID,reunions_ID) value(:date,:montant,:contenir_ID,:reunions_ID)';
        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":date", date("Y-m-d"));
        $requette->bindValue(":montant", $values);
        $requette->bindValue(":contenir_ID", $key);
        $requette->bindValue(":reunions_ID", $reunions_ID);
        $requette->execute();
    }
}


if (isset($_POST["enregistrement_caisse"])) {
    $reunions_ID = $_POST["reunions_ID"];
    $caisses_ID = $_POST["caisses_ID"];
    $montant_caisse = $_POST["montant_caisse"];
    $sql = 'DELETE FROM depots where reunions_ID=:reunions_ID;';
    $requette = $bdd->prepare($sql);
    $requette->bindValue(":reunions_ID", $reunions_ID);
    $requette->execute();

    foreach ($montant_caisse as $key => $values) {
        $sql = 'INSERT into depots (date_depot,montant,reunions_ID,caisses_ID,contenir_ID) value(:date_depot,:montant_caisse,:reunions_ID,:caisses_ID,:contenir_ID);';
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":date_depot", date("Y-m-d"));
        $requette->bindValue(":montant_caisse", $values);
        $requette->bindValue(":reunions_ID", $reunions_ID);
        $requette->bindValue(":caisses_ID", $caisses_ID);
        $requette->bindValue(":contenir_ID", $key);
        // var_dump($requette);
        $requette->execute();
    }
}


if (isset($_POST["prets"])) {
    $reunions_ID = $_POST["reunions_ID"];
    $caisses_ID = $_POST["caisses_ID"];
    $montant_prets = $_POST["montant_prets"];
    $sql = 'DELETE FROM prets where reunions_ID=:reunions_ID';
    $requette = $bdd->prepare($sql);
    $requette->bindValue(":reunions_ID", $reunions_ID);
    $requette->execute();

    foreach ($montant_prets as $key => $values) {
        $sql = 'INSERT into prets(date_pret,montant,reunions_ID,caisses_ID,contenir_ID) value(:date_pret,:montant_prets,:reunions_ID,:caisses_ID,:contenir_ID)';
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":date_pret", date("Y-m-d"));
        $requette->bindValue(":montant_prets", $values);
        $requette->bindValue(":reunions_ID", $reunions_ID);
        $requette->bindValue(":caisses_ID", $caisses_ID);
        $requette->bindValue(":contenir_ID", $key);
        $requette->execute();
    }
}
