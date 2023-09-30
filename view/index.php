<?php
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tableau de bord</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Sessions</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./session_liste.php">Liste des sessions</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Membres</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./membres_liste.php">Liste des membres</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Reunions</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./reunions_liste.php">Liste des reunions</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Caisses</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="caisses_liste.php">Liste des caisses</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            // on se connecte a la base de donnees
            include_once("../dbconfig/connexion.php");

            $sql = "SELECT * FROM  sessionss";

            // on prepare le requette
            $requette = $bdd->prepare($sql);

            // on execute la requette
            $requette->execute();

            // on stoque le resultat dans un tableau associatif
            $result = $requette->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="container-fluid px-4">
                <p class="mt-4">GESTION DES SESSIONS</p>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item ">Tableau de bord</li>
                    <li class="breadcrumb-item active">Sessions</li>
                </ol>
                <?php include("./_partial/alert_message.php"); ?>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Liste des sessions
                        <a href="./session_ajouter.php" class="btn btn-primary text-right" style='position:relative; float:right'><i class="fa fa-plus"></i> Ajouter une session</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-active table-striped">
                            <thead class="thead thead-primary">
                                <th>ID</th>
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
                                foreach ($result as $session) {
                                ?>
                                    <tr>
                                        <td><?= $session["sessionss_ID"] ?></td>
                                        <td><?= $session["titre"] ?></td>
                                        <td><?= $session["date_debut"] ?></td>
                                        <td><?= $session["date_fin"] ?></td>
                                        <td><?= $session["type_bouffe"] ?></td>
                                        <td><?= $session["durree"] ?></td>
                                        <td>
                                            <div class="d-flex text-center">
                                                <a class="btn-info btn-lg btn-sm" href="session_detail.php?id=<?= $session["sessionss_ID"] ?>" title="Voir plus"><i class="fas fa-eye"></i></a>
                                                <a class="btn-warning btn-lg btn-sm mx-2" href="session_modifier.php?id=<?= $session["sessionss_ID"] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
                                                <a class="btn-danger btn-lg btn-sm" href="../controller/session/sessionss_supprimer.php?id=<?= $session["sessionss_ID"] ?>" title="Supprimer"><i class="fas fa-trash"></i></a>
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