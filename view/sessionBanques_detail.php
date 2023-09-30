<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$banques_ID =$_GET["id"];
$sql = "SELECT * FROM  session_banques where banques_ID= $banques_ID";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$session_banques = $requette->fetch();

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SESSIONS DE BANQUES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Session de banque</li>
                <li class="breadcrumb-item active">Detail de la session de banque</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la session de banque
                </div>
                <div class="card-body">
                    <p>ID :<?= $session_banques["banques_ID"]?></p>
                    <hr>
                    <p>Date d'ouverture : <?= $session_banques["date_ouverture"] ?></p>
                    <hr>
                    <p>Date de fermeture : <?= $session_banques["date_fermeture"] ?></p>
                    <hr>
                    <p>
                        <a class="btn btn-primary" href="banques_detail.php?id=<?= $session_banques["banques_ID"] ?>">Retour</a>
                        <!-- <a class="btn btn-warning" href="sessionBanques_modifier.php?id=<?= $session_banques["banques_ID"] ?>">Modifier</a> -->
                    </p>
                </div>
            </div>
        </div>
    </main>
    <?php include("./_layout/footer.php") ?>