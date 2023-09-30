

<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  membres";

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
            <p class="mt-4">GESTION DES MEMBRES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item active">Membres</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des membres(<?= count($result); ?>)
                    <a href="./membres_ajouter.php" class="btn btn-primary" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter un membre</a>
                </div>
                <div class="card-body">
                <table id="datatablesSimple" class="table table-active table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Ville</th>
                        <th>Localisation</th>
                        <th>Fond</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                        // boucle sur la variable tableau
                            $i = 0;
                            foreach($result as $membres){
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $membres["nom"] ?></td>
                                    <td><?= $membres["prenom"] ?></td>
                                    <td><?= $membres["email"] ?></td>
                                    <td><?= $membres["telephone"] ?></td>
                                    <td><?= $membres["ville"] ?></td>
                                    <td><?= $membres["localisation"] ?></td>
                                    <td><?= $membres["fond"] ?></td>
                                    <td><?= $membres["statu"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm"  href="membres_detail.php?id=<?= $membres["membres_ID"]?>" title="Voir plus"><i class="fas fa-eye"></i></a> 
                                            <a class="btn btn-warning btn-sm mx-2" href="membres_modifier.php?id=<?= $membres["membres_ID"]?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../controller/membres/membres_supprimer.php?id=<?=$membres["membres_ID"]?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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
