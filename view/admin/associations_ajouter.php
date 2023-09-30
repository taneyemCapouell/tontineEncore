<?php
include("../admin/_layout/header.php");
include("../admin/_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="card mb-4">
            <div class="container-fluid px-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item ">Tableau de bord</li>
                    <li class="breadcrumb-item ">Associations</li>
                    <li class="breadcrumb-item active">Ajouter une association</li>
                </ol>
                <?php include("./_partial/alert_message.php"); ?>

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une association
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="../../controller/admin/traitement_associations.php">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="nom_license">Nom :</label>
                                    <input type="text" id="nom_associations" name="nom_associations" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="email">Email :</label>
                                    <input type="email" id="email" name="email" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="localisation">Localisation :</label>
                                    <input type="text" id="localisation" name="localisation" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="ville">Ville :</label>
                                    <input type="text" id="ville" name="ville" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="prix_license">Logo :</label>
                                    <input type="file" id="logo_associations" name="logo_associations" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="slogan_associations">Slogan :</label>
                                    <input type="text" id="slogan_associations" name="slogan_associations" class="form-control mt-2">
                                </div>
                            </div>

                            <div class="d-flex  align-items-center mt-4 mb-0">
                                <button type="submit" name="enregistrer" class="btn-primary mx-3 btn-lg">Enregistrer</button>
                                <button type="reset" class="btn-danger btn-lg">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("../admin/_layout/footer.php") ?>