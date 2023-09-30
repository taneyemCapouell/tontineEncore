<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  sanctions";

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
            <p class="mt-4">GESTION DES SANCTIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Sanctions</li>
                <li class="breadcrumb-item active">Liste des sanctions</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des sanctions
                    <a href="./sanctions_ajouter.php" class="btn btn-primary" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une sancton</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-active table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Cause</th>
                            <th>Montant</th>
                            <th>Delait</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($result as $sanctions) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $sanctions["cause"] ?></td>
                                    <td><?= $sanctions["montant"] ?></td>
                                    <td><?= $sanctions["delait"] ?></td>
                                    <td><?= $sanctions["statut"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="sanctions_detail.php?id=<?= $sanctions["sanctions_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i> </a>
                                            <a class="btn btn-warning btn-sm mx-2" href="sanctions_modifier.php?id=<?= $sanctions["sanctions_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../controller/sanctions/sanctions_supprimer.php?id=<?= $sanctions["sanctions_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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