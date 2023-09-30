<?php
include_once("../../dbconfig/connexion.php");

$sql = "SELECT * FROM  associations";

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
            <p class="mt-4">GESTION DES ASSOCIATIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Associations</li>
                <li class="breadcrumb-item active">Liste des associations</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des associations
                    <a href="./associations_ajouter.php" class="btn btn-primary " style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une association</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table text-center table-active  table-hover table-striped">
                        <thead class="">
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Localisation</th>
                            <th>Date</th>
                            <th>Slogan</th>
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
                                    <td><?= $i ?></td>
                                    <td><?= $associations["nom"] ?></td>
                                    <td><?= $associations["email"] ?></td>
                                    <td><?= $associations["localisation"] ?></td>
                                    <td><?= $associations["date_creation"] ?></td>
                                    <td><?= $associations["slogan"] ?></td>
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

    <?php include("../admin/_layout/footer.php") ?>