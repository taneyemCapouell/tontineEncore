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
                <li class="breadcrumb-item active">Listes des caisses</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des caisses
                    <a href="./caisses_ajouter.php" class="btn btn-primary" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une caisse</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-active table-striped">
                        <thead class="text-center">
                            <th>ID</th>
                            <th>Nom de la caisse</th>
                            <th>Description de la caisse</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($result as $caisses) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $caisses["nom_caisse"] ?></td>
                                    <td><?= $caisses["description"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="caisses_detail.php?id=<?= $caisses["caisses_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i> </a>
                                            <a class="btn btn-warning btn-sm mx-2" href="caisses_modifier.php?id=<?= $caisses["caisses_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../controller/caisses/caisses_supprimer.php?id=<?= $caisses["caisses_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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