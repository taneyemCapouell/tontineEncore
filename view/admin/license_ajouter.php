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
                    <li class="breadcrumb-item ">licenses</li>
                    <li class="breadcrumb-item active">Ajouter une license</li>
                </ol>
                <?php include("./_partial/alert_message.php"); ?>

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une license
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="../../controller/admin/traitement_licenses.php">
                        <div>
                            <div class="form-group">
                                <label for="nom_license">Nom :</label>
                                <input type="text" id="nom_license" name="nom_license" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="prix_license">Prix :</label>
                                <input type="number" id="prix_license" name="prix_license" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="durree">Durree ( En annees ):</label>
                                <input type="number" id="durree" name="durree" class="form-control mt-2">
                            </div>

                            <div class="btn mt-3">
                                <button type="submit" name="enregistrer" class="btn-primary btn-lg mx-2">Enregistrer</button>
                                <button type="reset" class="btn-danger btn-lg">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("../admin/_layout/footer.php") ?>
</div>