<?php
include_once("../../dbconfig/connexion.php");

$sql = "SELECT * FROM  license";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$resultat = $requette->fetchAll(PDO::FETCH_ASSOC);

include("../admin/_layout/header.php");
include("../admin/_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES LICENSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Licenses</li>
                <li class="breadcrumb-item active"> Liste des licenses</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des licenses
                    <a href="./license_ajouter.php" class="btn btn-primary " style='position:relative; float:right'><i class="fas fa-plus"></i>Ajouter une licence</a>
                </div>
                <div class="card-body">
                <!-- <tableid="dataTable" width="100%" cellspacing="0"> -->
                    <table id="datatablesSimple" width="100%" cellspacing="0" class="table teble-bordered text-center table-hover table-active table-striped">
                        <thead class="">
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Durree</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($resultat as $license) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $license["nom"] ?></td>
                                    <td><?= $license["prix"] ?></td>
                                    <td><?= $license["durree"] ?></td>
                                    <td>
                                    <div class="d-flex text-center">
                                        <a class="btn btn-info btn-sm" href="license_detail.php?id=<?= $license["license_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-warning btn-sm mx-2" href="./license_modifier.php?id=<?= $license["license_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" href="../../controller/admin/license_supprimer.php?id=<?= $license["license_ID"] ?>"  title="Supprimer"><i class="fas fa-trash"></i></a>
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

    <?php include("../admin/_layout/footer.php") ?>