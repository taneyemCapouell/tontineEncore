<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  sessionss";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$result = $requette->fetchAll(PDO::FETCH_ASSOC);

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES OPERATIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Operations</li>
                <li class="breadcrumb-item active">Ajouter une operation</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une operation
                </div>
                <div class="card-body">
                    <?php include("./_partial/alert_message.php"); ?>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>