<?php
include_once("../../dbconfig/connexion.php");

$sql = "SELECT * FROM  associations";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$resultat = $requette->fetchAll(PDO::FETCH_ASSOC);
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tableau de bord</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Association</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Liste des associations</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">License</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./license_liste.php">Liste des licenses</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Membres</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Liste des membres</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Membres</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Liste des membres</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-active">
                        <thead class="">
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Slogan</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($resultat as $associations) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $associations["associations_ID"] ?></td>
                                    <td><?= $associations["nom"] ?></td>
                                    <td><?= $associations["slogan"] ?></td>
                                    <td><?= $associations["logo"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="associations_detail.php?id=<?= $associations["associations_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm mx-2" href="./associations_modifier.php?id=<?= $associations["associations_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../../controller/admin/associations_supprimer.php?id=<?= $associations["associations_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>