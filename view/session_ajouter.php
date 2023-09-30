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

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SESSIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Sessions</li>
                <li class="breadcrumb-item active">Ajouter une session</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter une session
                </div>
                <div class="card-body">
                    <form method="POST" action="../controller/session/traitement_session.php" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="titre">Titre de la session :</label>
                                    <input type="text" id="titre" name="titre" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_debut">Date de debut :</label>
                                    <input type="date" id="date_debut" name="date_debut" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_fin">Date de fin :</label>
                                    <input type="date" id="nombre" name="date_fin" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="type_bouffe">Type bouffe : </label>
                                    <input type="text" id="type_bouffe" name="type_bouffe" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="durree_session">Durree de la session(En mois) : </label>
                                    <input type="number" min="0" id="durree_session" name="durree_session" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="nb_bouffer">Nombres de personne a bouffer : </label>
                                    <input type="number" min="0" max="2" step="any" id="nb_bouffer" name="nb_bouffer" class="form-control mt-2">
                                </div>

                            </div>

                            <table class="table table-striped table-bordered mt-4">
                                <thead class="bg-light text-center">
                                    <th>menbres</th>
                                    <th>montant a cotiser</th>
                                </thead>
                                <tbody>

                                    <?php
                                    include_once("../dbconfig/connexion.php");
                                    $sql = "SELECT * FROM membres order by nom";
                                    $requette = $bdd->prepare($sql);
                                    $requette->execute();
                                    $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($result = $requette->fetch()) {
                                        extract($result);
                                    ?>
                                        <tr>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="membres_ID[<?= $membres_ID ?>]" id="check_<?= $membres_ID ?>" onclick="activeLeChamp(<?= $membres_ID ?>)" class="checkbox" value="<?= $membres_ID ?>"> &nbsp;&nbsp;
                                                    <?= $nom . ' ' . $prenom ?>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="number" min="0" name="montant[<?= $membres_ID ?>]" disabled id="montant_<?= $membres_ID ?>" class="form-control">
                                            </td>
                                        </tr>
                                    <?php  }
                                    ?>
                                </tbody>
                            </table>

                            <div class="d-flex mt-4 ">
                                <button type="submit" name="enregistrer" class="btn-primary btn-lg mx-4">Enregistrer</button>
                                <button type="reset" class="btn-danger btn-lg">Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>
    <script>
        function activeLeChamp(id) {
            $('#check_' + id).is(':checked') ? $('#montant_' + id).attr('disabled', false).prop('required', true) : $('#montant_' + id).attr('disabled', true).prop('required', false).val('');
        }
    </script>