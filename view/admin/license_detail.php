<?php
    require_once("../../dbconfig/connexion.php");

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM license WHERE license_ID = :license_ID;";

    // on prepare la requette 
    $requette  = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':license_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $license = $requette->fetch();

    // on verifie si l'id existe 
    if (!$license) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:license_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:license_liste.php ");
    exit;
}

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SESSIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">license</li>
                <li class="breadcrumb-item active">Details</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la license
                </div>
                <div class="card-body">
                    <p>ID :<?= $license["license_ID"] ?></p>
                    <hr>
                    <p>Non :<?= $license["nom"] ?></p>
                    <hr>
                    <p>Prix :<?= $license["prix"] ?></p>
                    <hr>
                    <p>durree :<?= $license["durree"] ?></p>
                    <hr>
                    <p>
                        <a class="btn btn-primary" href="license_liste.php?id=<?= $license["license_ID"] ?>">Retour</a>
                        <a class="btn btn-warning" href="license_modifier?id=<?= $license["license_ID"] ?>">Modifier</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>