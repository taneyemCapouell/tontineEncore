<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM users WHERE users_ID = :users_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':users_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $users = $requette->fetch();

    // on verifie si l'id existe 
    if (!$users) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:users_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:users_liste.php ");
    exit;
}
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES UTILISATEURS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Utilisateurs</li>
                <li class="breadcrumb-item active">Modifier un utilisateur</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier un utilisateur
                </div>
                <?php include("./_partial/alert_message.php") ?>
                <div class="card-body">
                    <form method="POST" action="../../controller/admin/traitement_users.php" class="form">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titre">Nom :</label>
                                    <input type="text" id="nom" value="<?= $users['nom'] ?>" name="nom" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="date_debut">Prenom :</label>
                                    <input type="text" id="prenom" value="<?= $users['prenom'] ?>" name="prenom" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="mail">Email :</label>
                                    <input type="email" id="mail" value="<?= $users['email'] ?>" name="mail" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="telephone">Telephone : </label>
                                    <input type="number" id="telephone" value="<?= $users['telephone'] ?>" name="telephone" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" id="localisation" value="<?= $users['localisation'] ?>" name="localisation" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="role">Role : </label>
                                    <select class="form-control" id="role" name="role" class="form-control">
                                        <option>Utilisateur</option>
                                        <option>Administrateur</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="role">Genre : </label><br>
                                    <input type="radio" value="masculin" name="genre" class="form-check-input">
                                    <label class="form-input-label">Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="radio" value="feminin" name="genre" class="form-check-input">
                                    <label class="form-input-label">Feminin</label>
                                </div>

                                <div class="form-group">
                                    <label for="date_nais">Date de naissance : </label>
                                    <input type="date" id="date_nais" value="<?= $users['date_nais'] ?>" name="date_nais" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-4 mb-0">
                                <input type="hidden" name="users_ID" value="<?= $users['users_ID'] ?>">
                                <button type="submit" name="modifier" class="btn-primary btn-lg">Modifier</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("../admin/_layout/footer.php") ?>