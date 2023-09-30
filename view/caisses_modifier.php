<?php

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require("../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM caisses WHERE caisses_ID = :caisses_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':caisses_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $caisses = $requette->fetch();

    // on verifie si l'id existe 
    if (!$caisses) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:caisses_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:caisses_liste.php ");
    exit;
}
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES CAISSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Caisses</li>
                <li class="breadcrumb-item active">Modifier une caisse</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une caisse
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/caisses/traitement_caisses.php" class="form">
                        <div>
                            <div class="form-group mt-2">
                                <label for="nom_caisse">Nom de la caisse : </label>
                                <input type="text" value='<?= $caisses["nom_caisse"] ?>' id="nom_caisse" name="nom_caisse" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="description">Description de la caisse : </label>
                                <textarea class="form-control mt-2" name="description" id="description"> <?= $caisses["description"] ?></textarea>
                            </div>

                            <div class="btn mt-2">
                                <input type="hidden" value="<?= $caisses["caisses_ID"] ?>" name="caisses_ID">
                                <button type="submit" name="modifier" class="btn-primary btn-lg">Modifier</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("_layout/footer.php");
    ?>