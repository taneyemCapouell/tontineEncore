<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  reunions order by localisation asc";

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
            <p class="mt-4">GESTION DES REUNIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Reunions</li>
                <li class="breadcrumb-item active">Liste des reunions</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des reunions
                    <a href="./reunions_ajouter.php" class="btn btn-primary" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une reunion</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-active table-striped">
                        <thead>
                            <th>N</th>
                            <th>Date de reunion</th>
                            <th>Titre de la reunion</th>
                            <th>Localisation</th>
                            <th>Heure de debut</th>
                            <th>Heure de fin</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($result as $reunions) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $reunions["date_reunion"] ?></td>
                                    <td><?= $reunions["titre_reunion"] ?></td>
                                    <td><?= $reunions["localisation"] ?></td>
                                    <td><?= $reunions["heure_debut"] ?></td>
                                    <td><?= $reunions["heure_fin"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="reunions_detail.php?id=<?= $reunions["reunions_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm mx-2" href="reunions_modifier.php?id=<?= $reunions["reunions_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" name="supprimer" href="../controller/reunions/reunions_supprimer.php?id=<?= $reunions["reunions_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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