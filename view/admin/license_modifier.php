<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM license WHERE license_ID = :license_ID";

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
include("../admin/_layout/header.php");
include("../admin/_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES LICENSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item active">Licenses</li>
                <li class="breadcrumb-item active">Modifier une license</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une license
                </div>
                <div class="card-body">
                    <form method="post" class="form" action="../../controller/admin/traitement_licenses.php">
                        <div>
                            <div class="form-group">
                                <label for="nom_license">Nom :</label>
                                <input type="text" id="nom_license" name="nom_license" value='<?= $license["nom"] ?>' class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="prix_license">Prix :</label>
                                <input type="number" id="prix_license" name="prix_license" value='<?= $license["prix"] ?>' class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="durree">Durree de la licence :</label>
                                <input type="number" id="durree" name="durree" value='<?= $license["durree"] ?>' class="form-control">
                            </div>

                            <div class="btn">
                                <input type="hidden" value="<?= $license["license_ID"] ?>" name="license_ID">
                                <button type="submit" name="modifier" class="btn-primary btn-lg">Modifier</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("../admin/_layout/footer.php") ?>