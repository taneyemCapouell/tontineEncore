<?php
include_once("../../dbconfig/connexion.php");

$sql = "SELECT * FROM  souscrire";

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
            <p class="mt-4">GESTION DES SOUSCRIPTION</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Souscriptions</li>
                <li class="breadcrumb-item active">Liste des souscriptions</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des souscriptions
                    <button class="text-center btn btn-primary btn-sm" style='position:relative; float:right' data-bs-toggle="modal" data-bs-target="#modal1">
                        <i class="fas fa-plus"></i>
                        Ajouter une souscription
                    </button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table text-center table-active  table-hover table-striped">
                        <thead class="">
                            <th>ID</th>
                            <th>Date de souscription</th>
                            <th>License</th>
                            <th>Association</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($resultat as $souscrire) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $souscrire["date_souscription"] ?></td>
                                    <td><?= $souscrire["license_ID"] ?></td>
                                    <td><?= $souscrire["associations_ID"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="souscrire_detail.php?id=<?= $souscrire["souscrire_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                            <button class="text-center btn btn-sm btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#modal1<?= $souscrire["souscrire_ID"] ?>" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a class="btn btn-danger btn-sm" href="../../controller/admin/souscrire_supprimer.php?id=<?= $souscrire["souscrire_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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