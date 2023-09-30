<?php
// on se connecte a la base de donnees
include_once("../../dbconfig/connexion.php");

$sql = "SELECT * FROM  users";

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
            <p class="mt-4">GESTION DES UTILISATEURS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Utilisateurs</li>
                <li class="breadcrumb-item active">Liste des utilisateurs</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Liste des utilisateurs
                    <a href="./users_ajouter.php" class="btn btn-primary " style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover table-active table-striped text-center">
                        <thead>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Telephone </th>
                            <th>Localisation </th>
                            <th>Role</th>
                            <th>Genre</th>
                            <th>Association</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // boucle sur la variable tableau
                            $i = 0;
                            foreach ($result as $users) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $users["nom"] ?></td>
                                    <td><?= $users["prenom"] ?></td>
                                    <td><?= $users["email"] ?></td>
                                    <td><?= $users["telephone"] ?></td>
                                    <td><?= $users["localisation"] ?></td>
                                    <td><?= $users["role"] ?></td>
                                    <td><?= $users["genre"] ?></td>
                                    <td><?= $users["associations_ID"] ?></td>
                                    <td>
                                        <div class="d-flex text-center">
                                            <a class="btn btn-info btn-sm" href="./users_detail.php?id=<?= $users["users_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm mx-2" href="./users_modifier.php?id=<?= $users["users_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="../../controller/admin/users_supprimer.php?id=<?= $users["users_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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