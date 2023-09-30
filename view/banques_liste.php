<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  banques order by banques_ID asc";
// on prepare le requette
$requette = $bdd->prepare($sql);
$requette->execute();

// on stoque le resultat dans un tableau associatif
$result = $requette->fetchAll(PDO::FETCH_ASSOC);

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES BANQUES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Banques</li>
                <li class="breadcrumb-item active">Liste des banques</li>
            </ol>
            <?php
            include("./_partial/alert_message.php");
            ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des banques
                    <button class="text-center btn btn-primary btn-sm" style='position:relative; float:right' data-bs-toggle="modal" data-bs-target="#modal1">
                        <i class="fas fa-plus"></i>
                        Ajouter une banque
                    </button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table text-center table-active table-striped">
                        <thead class="text-center">
                            <th>ID</th>
                            <th>Nom de la banque</th>
                            <th>Montant maximun</th>
                            <th>Montant minimun</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($result as $banques) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $banques["nom_banque"] ?></td>
                                    <td><?= $banques["montant_max"] ?></td>
                                    <td><?= $banques["montant_min"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="banques_detail.php?id=<?= $banques["banques_ID"] ?>" title="Voir plus">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="text-center btn btn-sm btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#modal1<?=$banques["banques_ID"]?>" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a class="btn btn-danger btn-sm" href="../controller/banques/banques_supprimer.php?id=<?= $banques["banques_ID"]?>" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            include("./banques_modifier.php");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("./banques_ajouter.php");
    include("./_layout/footer.php");
    ?>