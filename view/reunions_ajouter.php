<?php
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES REUNIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Reunions</li>
                <li class="breadcrumb-item active">Ajouter une reunion</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une reunion
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/reunions/traitement_reunions.php" class="form">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group mt-2">
                                    <label for="heure_debut">Heure de debut : </label>
                                    <input type="time" id="heure_debut" name="heure_debut" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="heure_fin">Heure de fin : </label>
                                    <input type="time" id="heure_fin" name="heure_fin" class="form-control mt-2">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="titre_reunion">Titre de la reunion : </label>
                                    <input type="text" id="titre_reunion" name="titre_reunion" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" id="localisation" name="localisation" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="commentaire">Commentaire de la reunion: </label>
                                <textarea class="form-control mt-2" id="commentaire" name="commentaire"></textarea>
                            </div>
                            <div class="btn d-flex mt-3">
                                <button type="submit" name="enregistrer" class="btn-primary  btn-lg mx-3">Enregistrer</button>
                                <button type="reset" class="btn-danger  btn-lg">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>