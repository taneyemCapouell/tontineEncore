<?php
    require_once("../../dbconfig/connexion.php");

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM associations WHERE associations_ID = :associations_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':associations_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $associations = $requette->fetch();

    // on verifie si l'id existe 
    if (!$associations) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:associations_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:associations_liste.php ");
    exit;
}

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES ASSOCIATIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Associations</li>
                <li class="breadcrumb-item active">Details</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de l'association
                </div>
                <div class="card-body">
                    <p>ID :<?= $associations["associations_ID"] ?></p>
                    <p>Non :<?= $associations["nom"] ?></p>
                    <p>slogan :<?= $associations["slogan"] ?></p>
                    <p>Logo :<?= $associations["logo"] ?></p>
                    <p>
                        <a class="btn btn-primary" href="associations_liste.php?id=<?= $associations["associations_ID"] ?>">Retour</a>
                        <a class="btn btn-primary" href="associations_modifier?id=<?= $associations["associations_ID"] ?>">Modifier</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>