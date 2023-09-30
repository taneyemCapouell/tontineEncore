<?php
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$sessionss_ID =$_GET["id"];
$sql = "SELECT * FROM  sessionss where sessionss_ID=$sessionss_ID";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif
$session = $requette->fetch();

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SESSIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">sessions</li>
                <li class="breadcrumb-item active">Details de la session</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la session
                </div>
                <div class="card-body">
                    <p>N :<?= $session["sessionss_ID"] ?></p>
                    <hr>
                    <p>Titre de la session :<?= $session["titre"] ?></p>
                    <hr>
                    <p>Date de debut :<?= $session["date_debut"] ?></p>
                    <hr>
                    <p>Date de fin :<?= $session["date_fin"] ?></p>
                    <hr>
                    <p>Durree de la session :<?= $session["durree"] ?></p>
                    <hr>
                    <p>Type de bouffe :<?= $session["type_bouffe"] ?></p>
                    <hr>
                    <p>Associations :<?= $session["associations_ID"] ?></p>
                    <hr>

                    <table class="table table-striped table-bordered mt-4">
                    <thead class="bg-light text-center">
                        <th>Menbres</th>
                        <th>Montant a cotiser</th>
                        <th>Date de bouffe</th>
                    </thead>
                    <tbody>
                        <?php
                        $sessionss_ID =$_GET["id"];
                        include_once("../dbconfig/connexion.php");
                        $sql = "SELECT m.nom, m.prenom, c.montant_a_cotiser,c.bouffer_le FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID order by nom";
                        $requette = $bdd->prepare($sql);
                        $requette->execute();
                        // var_dump($requette);
                        $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                        while ($result = $requette->fetch()) {
                            extract($result);
                        ?>
                            <tr>
                                <td><?=$nom." ".$prenom?></td>
                                <td><?=$montant_a_cotiser?></td>
                                <td><?=$bouffer_le?></td>
                            </tr>
                        <?php  }
                        ?>
                    </tbody>
                    </table>
                    <p>
                        <a class="btn btn-primary" href="session_liste.php?id=<?= $session["sessionss_ID"] ?>">Retour</a>
                        <a class="btn btn-warning" href="session_modifier.php?id=<?= $session["sessionss_ID"] ?>">Modifier</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>