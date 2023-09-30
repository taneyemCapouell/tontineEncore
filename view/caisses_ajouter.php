<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  caisses";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$result = $requette->fetchAll(PDO::FETCH_ASSOC);

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES CAISSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Caisses</li>
                <li class="breadcrumb-item active">Ajouter une caisse</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une caisse
                </div>
                <div class="card-body">
                    <?php include("./_partial/alert_message.php"); ?>
                    <form method="POST" action="../controller/caisses/traitement_caisses.php" class="form">
                        <div>

                            <div class="form-group mt-2">
                                <label for="nom_caisse">Nom de la caisse : </label>
                                <select class="form-control mt-2" id="statu" name="nom_caisse">
                                    <option value="fon d'aide">Fon d'aide</option>
                                    <option value="fon de fonctionnement">Fon de fonctionnement</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="description">Description de la caisse : </label>
                                <textarea class="form-control mt-2" id="description" name="description"></textarea>
                            </div>

                            <div class="d-flex align-items-center mt-4 mb-0">
                                <button type="submit" name="enregistrer" class="btn-primary mx-3 btn-lg">Enregistrer</button>
                                <button type="reset" class="btn-danger btn-block btn-lg">Fermer</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>