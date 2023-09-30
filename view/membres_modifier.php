<?php
require_once('../dbconfig/connexion.php');
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM membres WHERE membres_ID = :membres_ID";
    $requette = $bdd->prepare($sql);
    $requette->bindValue(':membres_ID', $id, PDO::PARAM_INT);
    $requette->execute();
    $membres = $requette->fetch();
    if (!$membres) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:membres_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:membres_liste.php ");
    exit;
}

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES MEMBRES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Membres</li>
                <li class="breadcrumb-item active">Modifier un membres</li>
            </ol>
            <?php include("_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier un membres
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/membres/traitement_membres.php" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titre">Nom : </label>
                                    <input type="text" value="<?= $membres["nom"] ?>" id="nom" name="nom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_debut">Prenom : </label>
                                    <input type="text" value="<?= $membres["prenom"] ?>" id="prenom" name="prenom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="mail">Email : </label>
                                    <input type="email" value="<?= $membres["email"] ?>" id="mail" name="mail" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="telephone">Telephone : </label>
                                    <input type="number" value="<?= $membres["telephone"] ?>" id="telephone" name="telephone" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="ville">Ville : </label>
                                    <input type="text" value="<?= $membres["ville"] ?>" id="ville" name="ville" class="form-control mt-2">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="role">Genre : </label><br>
                                    <input type="radio" value="masculin" name="genre" class="form-check-input mt-2">
                                    <label class="form-input-label mt-2">Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="radio" value="feminin" name="genre" class="form-check-input mt-2">
                                    <label class="form-input-label mt-2">Feminin</label>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" value="<?= $membres["localisation"] ?>" id="localisation" name="localisation" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="fond">Fond : </label>
                                    <input type="number" value="<?= $membres["fond"] ?>" id="fond" name="fond" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_nais">Date de naissance : </label>
                                    <input type="date" value="<?= $membres["date_nais"] ?>" id="date_nais" name="date_nais" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="statu">Role : </label>
                                    <select class="form-control mt-2" id="statu" name="statu">
                                        <option value="Vice president">Vice president</option>
                                        <option value="Secretaire">Secretaire</option>
                                        <option value="Vice secretaire">Vice secretaire</option>
                                        <option value="Repporteur">Repporteur</option>
                                        <option value="Tresorier">Tresorier</option>
                                        <option value="Vice tresorier">Vice tresorier</option>
                                        <option value="Commissaire au compte">Commissaire au compte</option>
                                        <option value="Senseur">Senseur</option>
                                        <option value="Membre">Membre</option>
                                    </select>
                                </div>

                            </div>
                            <div class="d-flex align-items-center mt-4 mb-0">
                                <input type="hidden" value="<?= $membres["membres_ID"] ?>" name="membres_ID">
                                <button type="submit" name="modifier" class="btn-primary btn-lg">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("_layout/footer.php") ?>