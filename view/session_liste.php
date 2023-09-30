

<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  sessionss";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$result = $requette -> fetchAll(PDO::FETCH_ASSOC);

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SESSIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item active">Sessions</li>
                <li class="breadcrumb-item active">Listes des sessions</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des sessions
                    <a href="./session_ajouter.php" class="btn btn-sm btn-primary" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une session</a>
                </div>
                <div class="card-body">
                <table id="datatablesSimple" class="table table-active table-striped">
                    <thead class="">
                        <th>ID</th>
                        <!-- <th>Statut</th> -->
                        <th>Titre</th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
                        <th>Type bouffe</th>
                        <th>Durree</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        // boucle sur la variable tableau
                        $i = 0;
                            foreach($result as $session){
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <!-- <td><?= $session["statu?t"]?></td> -->
                                    <td><?= $session["titre"] ?></td>
                                    <td><?= $session["date_debut"] ?></td>
                                    <td><?= $session["date_fin"] ?></td>
                                    <td><?= $session["type_bouffe"] ?></td>
                                    <td><?= $session["durree"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm"  href="session_detail.php?id=<?=$session["sessionss_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i> </a> 
                                            <a class="btn btn-warning btn-sm mx-2" href="session_modifier.php?id=<?=$session["sessionss_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" name="supprimer" href="../controller/session/sessionss_supprimer.php?id=<?=$session["sessionss_ID"] ?>" title="Supprimer" ><i class="fas fa-trash"></i></a>
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
