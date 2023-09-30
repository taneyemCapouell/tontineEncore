<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require("../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM sanctions WHERE sanctions_ID = :sanctions_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':sanctions_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $sanctions = $requette->fetch();

    // on verifie si l'id existe 
    if (!$sanctions) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:sanctions_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:sanctions_liste.php ");
    exit;
}
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SANCTIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Sanctions</li>
                <li class="breadcrumb-item active">Modifier une sanction</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une sanction
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/sanctions/traitement_sanctions.php" class="form">
                        <div>

                            <div class="form-group">
                                <label for="cause">Cause : </label>
                                <input type="text" value='<?= $sanctions["cause"] ?>' id="cause" name="cause" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="montant">Montant : </label>
                                <input type="number" value='<?= $sanctions["montant"] ?>' id="montant" name="montant" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="delait">Delait : </label>
                                <input type="date" value='<?= $sanctions["delait"] ?>' id="delait" name="delait" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="statut">Statut : </label>
                                <select class="form-control mt-2" id="statut" name="statut">
                                    <option>Non payer</option>
                                    <option>Payer</option>
                                </select>
                            </div>

                            <div class="d-flex align-items-center mt-4 mb-0">
                                <input type="hidden" value="<?=$sanctions["sanctions_ID"] ?>" name="sanctions_ID">
                                <button type="submit" name="modifier" class="btn-primary  btn-lg">Modifier</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("_layout/footer.php") ?>