<?php
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
                <li class="breadcrumb-item active">Ajouter un membre</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter un membre
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/membres/traitement_membres.php" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="titre">Nom : </label>
                                    <input type="text" id="nom" name="nom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_debut">Prenom : </label>
                                    <input type="text" id="prenom" name="prenom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="mail">Email : </label>
                                    <input type="email" id="mail" name="mail" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="telephone">Telephone : </label>
                                    <input type="number" id="telephone" name="telephone" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="ville">Ville : </label>
                                    <input type="text" id="ville" name="ville" class="form-control mt-2">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group mt-2">
                                    <label for="role">Genre : </label><br>
                                    <input type="radio" value="masculin" name="genre" class="form-check-input mt-2">
                                    <label class="form-input-label mt-2">Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="radio" value="feminin" name="genre" class="form-check-input  mt-2">
                                    <label class="form-input-label mt-2">Feminin</label>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" id="localisation" name="localisation" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="fond">Fond : </label>
                                    <input type="number" id="fond" name="fond" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_nais">Date de naissance : </label>
                                    <input type="date" id="date_nais" name="date_nais" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="statu">Role : </label>
                                    <select class="form-control mt-2" id="statu" name="statu">
                                        <option>Vice president</option>
                                        <option>Secretaire</option>
                                        <option>Vice secretaire</option>
                                        <option>Tresorier</option>
                                        <option>Vice tresorier</option>
                                        <option>Commissaire au compte</option>
                                        <option>Senseur</option>
                                        <option>Simple membre</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center mt-4 mb-0">
                            <button type="submit" name="enregistrer" class="btn-primary mx-4 btn-lg">Enregistrer</button>
                            <button type="reset" class="btn-danger btn-lg">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>

<?php include("_layout/footer.php") ?>