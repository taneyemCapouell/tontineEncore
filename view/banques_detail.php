<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$banques_ID =$_GET["id"];

$sql = "SELECT * FROM  banques where banques_ID=$banques_ID";
// on prepare la requette
$requette = $bdd->prepare($sql);    
// on execute la requette
$requette->execute();
// on stoque le resultat dans un tableau associatif
$banques = $requette->fetch();

$sql = "SELECT * FROM  session_banques";
$requette = $bdd->prepare($sql);
$requette->execute();
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
                <li class="breadcrumb-item active">Detail de la banque</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la banque
                </div>
                <div class="card-body">
                    <p>ID :<?= $banques["banques_ID"] ?></p>
                    <hr>
                    <p>Nom de la caisse : <?= $banques["nom_banque"] ?></p>
                    <hr>
                    <p>Montant maximun : <?= $banques["montant_max"] ?></p>
                    <hr>
                    <p>Montant minimun : <?= $banques["montant_min"] ?></p>
                    <hr>
                    <p>
                        <a class="btn btn-primary" href="banques_liste.php?id=<?= $banques["banques_ID"] ?>">Retour</a>
                        <!-- <button class="text-center btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#modal1<?= $banques["banques_ID"] ?>" title="Modifier" href="id=<?= $banques["banques_ID"] ?>">
                            Modifier une banque
                        </button> -->
                    </p>
                </div>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste de la session de banque
                <button class="text-center btn btn-primary btn-sm" style='position:relative; float:right' data-bs-toggle="modal" data-bs-target="#modal2">
                    <i class="fas fa-plus"></i>
                    Ajouter une session de banque
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table text-center table-active table-striped">
                    <thead class="text-center">
                        <th>ID</th>
                        <th>Statut</th>
                        <th>Date d'ouverture</th>
                        <th>Date de fermeture</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        // boucle sur la variable tableau
                        $i = 0;
                        foreach ($result as $session_banques) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>
                                    <?php if ($_SESSION["statut"] == 1) {
                                            echo "Ouverte";
                                        } else {
                                            echo "Fermee";
                                        }
                                    ?>
                                </td>
                                <td><?= $session_banques["date_ouverture"] ?></td>
                                <td><?= $session_banques["date_fermeture"] ?></td>
                                <td>
                                    <div class="d-flex text-center">
                                        <a class="btn btn-danger btn-sm mx-2" href="../controller/session_banques/traitement_session_banques.php" name="fermer" title="Fermer la session"><i class="fas fa-times"></i></a>
                                        <a class="btn btn-info btn-sm" href="sessionBanques_detail.php?id=<?= $session_banques["session_banques_ID"] ?>" title="Voir plus">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="text-center btn btn-sm btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#modal2<?= $session_banques["session_banques_ID"]?>" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a class="btn btn-danger btn-sm" href="../controller/session_banques/session_banques_supprimer.php?id=<?= $session_banques["session_banques_ID"] ?>" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            include("sessionBanques_modifier.php");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php
    include("./sessionBanques_ajouter.php");
    include("./_layout/footer.php")
    ?>