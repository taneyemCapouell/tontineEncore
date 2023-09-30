<?php
    require_once("../../dbconfig/connexion.php");

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM associations WHERE associations_ID = :associations_ID;";
    $requette  = $bdd->prepare($sql);
    $requette->bindValue(':associations_ID', $id, PDO::PARAM_INT);
    // on execute la requette 
    $requette->execute();
    // on recupere le produit(resultat de la requette)
    $associations = $requette->fetch();

    $sql = "SELECT logo from associations WHERE associations_ID = $id;";
    $requette = $bdd->prepare($sql);
    $requette->execute();
    $result = $requette->fetch();
    $logo = $result['logo'];

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
                    <div class="row">

                        <div class="col-md-6">
                            <p>ID : <?= $associations["associations_ID"] ?></p>
                            <hr>
                            <p>Non : <?= $associations["nom"] ?></p>
                            <hr>
                            <p>Ville : <?= $associations["ville"] ?></p>
                            <hr>
                            <p>Localisation : <?= $associations["localisation"] ?></p>
                            <hr>
                            <p>Slogan : <?= $associations["slogan"] ?></p>
                            <hr>
                            <p>Email : <?= $associations["email"] ?></p>
                            <hr>
                            <p>Date : <?= $associations["date_creation"] ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <img src="data:image/JPG;base64,<?= base64_encode($logo) ?>"/>
                        </div>
                    </div>
                    <p>
                        <a class="btn btn-primary mx-2" href="associations_liste.php?id=<?= $associations["associations_ID"] ?>">Retour</a>
                        <a class="btn btn-warning" href="associations_modifier?id=<?= $associations["associations_ID"] ?>">Modifier</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>