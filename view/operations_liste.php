<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  operations";

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
            <p class="mt-4">GESTION DES OPERATIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Operations</li>
                <li class="breadcrumb-item active">Liste des operations</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header ">
                    <i class="fas fa-table me-1"></i>
                    Liste des operations
                    <div class="text-center btn btn-primary" style='position:relative; float:right' data-bs-toggle="modal" data-bs-target="#modal1">
                        <i class="fa fa-plus"></i> Ajouter une operation
                    </div>
                </div>
                <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Montant cotiser</th>
                            <th>Montant de retrait</th>
                            <th>Date d'operation</th>
                            <th>Caisse</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            foreach ($result as $operations) {
                                $i = 0;
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $operations["montant_cotiser"] ?></td>
                                    <td><?= $operations["montant_retrait"] ?></td>
                                    <td><?= $operations["date_operation"] ?></td>
                                    <td><?= $operations["caisses_ID"] ?></td>
                                    <td>
                                        <div class="d-flex ">
                                            <a class="btn btn-info btn-sm" href="operations_detail.php?id=<?= $operations["operations_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i> </a>
                                            <a class="btn btn-warning btn-sm mx-2" href="operations_modifier.php?id=<?= $operations["operations_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../controller/operations/operations_supprimer.php?id=<?= $operations["operations_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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