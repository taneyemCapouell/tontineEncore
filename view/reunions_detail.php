<?php
$reunions_ID = $_GET["id"];
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  reunions where reunions_ID=$reunions_ID";

// on prepare le requette
$requette = $bdd->prepare($sql);

// on execute la requette
$requette->execute();

// on stoque le resultat dans un tableau associatif

$reunions = $requette->fetch();
$sessionss_ID = $reunions["sessionss_ID"];
$sql = "SELECT * FROM sessionss where sessionss_ID=$sessionss_ID";
$requette = $bdd->prepare($sql);
$requette->execute();
$sessions = $requette->fetch();

$sql = "SELECT m.nom,m.prenom ,c.montant_bouffer FROM membres m ,contenir c, reunions r WHERE m.membres_ID=c.membres_ID AND r.reunions_ID=$reunions_ID and (r.contenir_ID=c.contenir_ID or c.contenir_ID=r.contenir_ID2)";
$beneficiaires = $bdd->prepare($sql);
$beneficiaires->execute();


$sql = "SELECT m.nom, m.prenom, c.montant FROM cotiser c, membres m ,contenir co where c.reunions_ID=$reunions_ID AND c.contenir_ID = co.contenir_ID AND co.membres_ID=m.membres_ID";
$cotisations = $bdd->prepare($sql);
$cotisations->execute();


$sql = "SELECT m.nom, m.prenom, c.nom_caisse, d.montant FROM caisses c, membres m ,contenir co, depots d where d.reunions_ID=$reunions_ID AND co.contenir_ID = d.contenir_ID AND d.caisses_ID = c.caisses_ID AND co.membres_ID=m.membres_ID";
$caisses = $bdd->prepare($sql);
$caisses->execute();

$sql = "SELECT m.nom, m.prenom, c.nom_caisse ,p.montant FROM caisses c, membres m ,contenir co, prets p where p.reunions_ID=$reunions_ID AND co.contenir_ID = p.contenir_ID AND p.caisses_ID = c.caisses_ID AND co.membres_ID=m.membres_ID";
$prets = $bdd->prepare($sql);
$prets->execute();


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
                <li class="breadcrumb-item active">Details de la Reunions</li>
            </ol>
            <button class="btn btn-ligth float-end" onclick="printElement('to-print')" id="print-"><i class="fa fa-print"></i> Imprimer</button><br>
            <div class="card mb-4" id="to-print">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de reunion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N_: <strong><?= $reunions["reunions_ID"] ?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;du &nbsp;&nbsp;&nbsp; <strong><?= $reunions["date_reunion"] ?></strong>
                </div>
                <div class="card-body">
                    <label class="float-end h3"><?= $_SESSION["nom"] ?> </label><br><br>
                    <h5 class="text-uppercase">Informations Generales</h5>
 
                    <label>Session N_ : <strong><?= $sessions["sessionss_ID"] ?></strong></label><br>
                    <label>Titre : <strong><?= $sessions["titre"] ?></strong></label><br>
                    <label>Débuté le: <strong><?= $sessions["date_debut"] ?></strong></label>
                    <table class="table table-striped table-bordered mt-4">
                        <thead class="bg-light text-center">
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>H.debut</th>
                            <th>H.fin </th>
                            <th>Lieu</th>
                            <th>Résumé</th>
                            <th>Beneficiaires</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $reunions["reunions_ID"] ?></td>
                                <td><?= $reunions["titre_reunion"] ?></td>
                                <td><?= $reunions["date_reunion"] ?></td>
                                <td><?= $reunions["heure_debut"] ?></td>
                                <td><?= $reunions["heure_fin"] ?></td>
                                <td><?= $reunions["localisation"] ?></td>
                                <td><?= $reunions["commentaire"] ?></td>
                                <td>
                                    <?php
                                    while ($beneficiaire = $beneficiaires->fetch()) {
                                        echo $beneficiaire["nom"] . " " . $beneficiaire["prenom"] . " : <strong>" . $beneficiaire["montant_bouffer"] . " </strong><br>";
                                    }

                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-5">
                            <h5 class="text-uppercase">Cotisations</h5>
                            <table class="table table-striped table-bordered mt-4">
                                <thead class="bg-light text-center">
                                    <th>Menbres</th>
                                    <th>Montant cotisé</th>
                                </thead>
                                <tbody>
                                    <?php
                                    // var_dump($requette);
                                    while ($cotisation = $cotisations->fetch()) {
                                        extract($cotisation);
                                    ?>
                                        <tr>
                                            <td><?= $nom . " " . $prenom ?></td>
                                            <td><?= $montant ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <h5 class="text-uppercase">Deposition en caisse</h5>
                            <table class="table table-striped table-bordered mt-4">
                                <thead class="bg-light text-center">
                                    <th>Menbres</th>
                                    <th>Montant</th>
                                    <th>Caisses de retrait</th>
                                </thead>
                                <tbody>
                                    <?php
                                    // var_dump($requette);
                                    while ($caisse = $caisses->fetch()) {
                                        extract($caisse);
                                    ?>
                                        <tr>
                                            <td><?= $nom . " " . $prenom ?></td>
                                            <td><?= $montant ?></td>
                                            <td><?= $nom_caisse ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-uppercase">Prets</h5>
                        <table class="table table-striped table-bordered mt-4">
                            <thead class="bg-light text-center">
                                <th>Menbres</th>
                                <th>Montant</th>
                                <th>Caisses de retrait</th>
                            </thead>
                            <tbody>
                                <?php
                                // var_dump($requette);
                                while ($pret = $prets->fetch()) {
                                    extract($pret);
                                ?>
                                    <tr>
                                        <td><?= $nom . " " . $prenom ?></td>
                                        <td><?= $montant ?></td>
                                        <td><?= $nom_caisse ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <p>
                <a class="btn btn-primary" href="reunions_liste.php?id=<?= $reunions["reunions_ID"] ?>">Retour</a>
                <a class="btn btn-warning" href="reunions_modifier.php?id=<?= $reunions["reunions_ID"] ?>">Modifier</a>
            </p>
        </div>
    </main>
    <style>
        @media print {
            body * {
                visibility: hidden;
                /* fa fa-print to-print print-btn*/
            }

            #to-print,
            #to-print * {
                visibility: hidden;
            }

            #to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
    <script>
        function printElement(element) {
            var printContents = document.getElementById(element).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <?php include("./_layout/footer.php") ?>