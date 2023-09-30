<?php
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
                <li class="breadcrumb-item active">Ajouter une sanction</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une sanction
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/sanctions/traitement_sanctions.php" class="form">
                        <div>

                            <div class="form-group">
                                <label for="cause">Cause : </label>
                                <input type="text" id="cause" name="cause" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="montant">Montant : </label>
                                <input type="number" id="montant" name="montant" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="delait">Delait : </label>
                                <input type="date" id="delait" name="delait" class="form-control mt-2">
                            </div>

                            <div class="form-group mt-2">
                                <label for="statut">Statut : </label>
                                <select class="form-control mt-2" id="statut" name="statut">
                                    <option>Non payer</option>
                                    <option>Payer</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex  align-items-center mt-4 mb-0">
                            <button type="submit" name="enregistrer" class="btn-primary ml-3 mx-3  btn-lg">Enregistrer</button>
                            <button type="reset" class="btn-danger  btn-lg">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include("./_layout/footer.php") ?>