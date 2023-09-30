<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM associations WHERE associations_ID = :associations_ID";

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
    header("location:associations_liste.php");
    exit;
}

include("../admin/_layout/header.php");
include("../admin/_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES ASSOCIATIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Associations</li>
                <li class="breadcrumb-item active">Modifier une association</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une association
                </div>
                <?php include("../_partial/alert_message.php") ?>
                <div class="card-body">
                    <form class="form" action="../../controller/admin/traitement_associations.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom_associations">Nom :</label>
                                    <input type="text" value='<?= $associations["nom"] ?>' id="nom_associations" name="nom_associations" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="email">Email :</label>
                                    <input type="text" value='<?= $associations["email"] ?>' id="email" name="email" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="ville">Ville :</label>
                                    <input type="text" value='<?= $associations["ville"] ?>' id="ville" name="ville" class="form-control mt-2">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="localisation">Localisation :</label>
                                    <input type="text" value='<?= $associations["slogan"] ?>' id="localisation" name="localisation" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="slogan_associations">Slogan :</label>
                                    <input type="text" value='<?= $associations["slogan"] ?>' id="slogan_associations" name="slogan_associations" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="logo_associations">Logo :</label>
                                    <input type="file" value='<?= $associations["logo"] ?>' id="logo_associations" name="logo_associations" class="form-control mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="btn mt-2">
                            <input type="hidden" value="<?= $associations["associations_ID"] ?>" name="associations_ID">
                            <button type="submit" name="modifier" class="btn-primary btn-lg">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("../admin/_layout/footer.php") ?>