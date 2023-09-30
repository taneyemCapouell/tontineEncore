<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require("../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM sessionss WHERE sessionss_ID=:sessionss_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':sessionss_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $sessions = $requette->fetch();

    // on verifie si l'id existe 
    if (!$sessions) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:session_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:session_liste.php ");
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
                <li class="breadcrumb-item ">Sessions</li>
                <li class="breadcrumb-item active">Modifier une session</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une session
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/session/traitement_session.php" class="form">
                        <div>
                            <div class="form-group">
                                <label for="titre">Titre de la session :</label>
                                <input type="text" id="titre" value='<?= $sessions["titre"] ?>' name="titre" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="date_debut">Date de debut :</label>
                                <input type="date" id="date_debut" value='<?= $sessions["date_debut"] ?>' name="date_debut" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="date_fin">Date de fin :</label>
                                <input type="date" id="date_fin" value='<?= $sessions["date_fin"] ?>' name="date_fin" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2"> 
                                <label for="type_bouffe">Type bouffe : </label>
                                <input type="text" id="type_bouffe" value='<?= $sessions["type_bouffe"] ?>' name="type_bouffe" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="durree_session">Durree(En mois) : </label>
                                <input type="number" id="durree_session" value='<?= $sessions["durree"] ?>' name="durree_session" class="form-control mt-2">
                            </div>
                            <div class="btn mt-4">
                                <input type="hidden" value="<?= $sessions["sessionss_ID"] ?>" name="sessionss_ID">
                                <button type="submit" name="modifier" class="btn-primary  btn-lg">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("_layout/footer.php") ?>