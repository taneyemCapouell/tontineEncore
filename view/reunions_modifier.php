<?php
// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require("../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM reunions WHERE reunions_ID = :reunions_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':reunions_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $reunions = $requette->fetch();

    // on verifie si l'id existe 
    if (!$reunions) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:reunions_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:reunions_liste.php ");
    exit;
}

$reunions_ID = $_GET["id"];
$sql = "SELECT MAX(sessionss_ID) as sessionss_ID  FROM sessionss";
$requette = $bdd->prepare($sql);
$requette->execute();  
$sessionss_ID = $requette->fetch();
$sessionss_ID = $sessionss_ID["sessionss_ID"];

$sql = "SELECT m.nom,m.prenom ,c.montant_bouffer, c.contenir_ID FROM membres m ,contenir c, reunions r WHERE m.membres_ID=c.membres_ID AND r.reunions_ID=$reunions_ID and r.contenir_ID=c.contenir_ID";
$beneficiaire1 = $bdd->prepare($sql);
$beneficiaire1->execute();
$beneficiaire1 = $beneficiaire1->fetch();

$sql = "SELECT m.nom,m.prenom ,c.montant_bouffer, c.contenir_ID FROM membres m ,contenir c, reunions r WHERE m.membres_ID=c.membres_ID AND r.reunions_ID=$reunions_ID and c.contenir_ID=r.contenir_ID2";
$beneficiaire2 = $bdd->prepare($sql);
$beneficiaire2->execute();
$beneficiaire2 = $beneficiaire2->fetch();

$sql = "SELECT m.nom, m.prenom, c.montant, co.contenir_ID FROM cotiser c, membres m ,contenir co where c.reunions_ID=$reunions_ID AND c.contenir_ID = co.contenir_ID AND co.membres_ID=m.membres_ID";
$cotisations = $bdd->prepare($sql);
$cotisations->execute();

$sql = "SELECT m.nom, m.prenom, c.nom_caisse, d.montant, co.contenir_ID FROM caisses c, membres m ,contenir co, depots d where d.reunions_ID=$reunions_ID AND co.contenir_ID = d.contenir_ID AND d.caisses_ID = c.caisses_ID AND co.membres_ID=m.membres_ID";
$caisses = $bdd->prepare($sql);
$caisses->execute();

$sql = "SELECT m.nom, m.prenom, c.nom_caisse ,p.montant, co.contenir_ID FROM caisses c, membres m ,contenir co, prets p where p.reunions_ID=$reunions_ID AND co.contenir_ID = p.contenir_ID AND p.caisses_ID = c.caisses_ID AND co.membres_ID=m.membres_ID";
$prets = $bdd->prepare($sql);
$prets->execute();

$sql = "SELECT m.nom,m.prenom,contenir_ID,c.montant_a_cotiser FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID";
$requette1 = $bdd->prepare($sql);
$requette1->execute();

$sql = "SELECT m.nom,m.prenom,contenir_ID,c.montant_a_cotiser FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID";
$requette2 = $bdd->prepare($sql);
$requette2->execute();

$sql = "SELECT m.nom,m.prenom,contenir_ID,c.montant_a_cotiser FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID";
$requette3 = $bdd->prepare($sql);
$requette3->execute();

$sql = "SELECT m.nom,m.prenom,contenir_ID,c.montant_a_cotiser FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID";
$requette4 = $bdd->prepare($sql);
$requette4->execute();

$sql = "SELECT m.nom,m.prenom,contenir_ID,c.montant_a_cotiser FROM membres m ,contenir c WHERE m.membres_ID=c.membres_ID AND c.sessionss_ID= $sessionss_ID";
$requette5 = $bdd->prepare($sql);
$requette5->execute();

$sql = "SELECT * FROM caisses";
$query1 = $bdd->prepare($sql);
$query1->execute();

$sql = "SELECT * FROM caisses";
$query2 = $bdd->prepare($sql);
$query2->execute();


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
                <li class="breadcrumb-item active">Modifier une reunion</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Information de base de la reunion
                </div>
                <div class="card-body">
                    <form method="POST" action="#" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_reunion">Date de reunion : </label>
                                    <input type="date" id="date_reunion" value='<?= $reunions["date_reunion"] ?>' name="date_reunion" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="heure_debut mt-2">Heure de debut : </label>
                                    <input type="time" id="heure_debut" value='<?= $reunions["heure_debut"] ?>' name="heure_debut" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="heure_fin">Heure de fin : </label>
                                    <input type="time" id="heure_fin" value='<?= $reunions["heure_fin"] ?>' name="heure_fin" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" id="localisation" value='<?= $reunions["localisation"] ?>' name="localisation" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="titre_reunion">Titre de la reunion : </label>
                                    <input type="text" value='<?= $reunions["titre_reunion"] ?>' id="titre_reunion" name="titre_reunion" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="commentaire">Commentaire de la reunion: </label>
                                    <textarea rows="1" class="form-control mt-2" id="commentaire" name="commentaire"><?= $reunions["localisation"] ?></textarea>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered mt-4">
                                <thead class="bg-light text-center">
                                    <th>Beneficiaire1</th>
                                    <th>Beneficiaire2</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" type="select" name="beneficiaire1">
                                                <?php
                                                while ($result = $requette1->fetch()) {
                                                    extract($result);
                                                    $selected="";
                                                    if($beneficiaire1){
                                                    $selected = $beneficiaire1["contenir_ID"] == $contenir_ID ? "selected" : "";
                                                    }
                                                    echo "<option $selected value='$contenir_ID'>$nom  $prenom</option>";
                                                    
                                                }
                                                ?>
                                            </select>

                                            <div class="form-group mt-2">
                                                <input type="number" placeholder="Montant bouffer" min="0" name="montant1" value="<?= $beneficiaire1["montant_bouffer"]??'' ?>" class="form-control">
                                            </div>
                                        </td>
                                        <td>

                                            <select class="form-control" type="select" name="beneficiaire2">
                                                <?php
                                                while ($result = $requette2->fetch()) {
                                                    extract($result);
                                                    $selected="";
                                                    if($beneficiaire2){
                                                    $selected = $beneficiaire2["contenir_ID"] == $contenir_ID ? "selected" : "";
                                                    }
                                                    echo "<option  $selected value='$contenir_ID'>$nom  $prenom</option>";
                                                    
                                                }
                                                ?>
                                            </select>

                                            <div class="form-group mt-2">
                                                <input type="number" placeholder="Montant bouffer" min="0" name="montant2" value="<?= $beneficiaire2["montant_bouffer"] ?? "" ?>" class="form-control">
                                            </div>
                                            <?php

                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex  align-items-center mt-1 mb-0">
                                <input type="hidden" value='<?= $reunions["reunions_ID"] ?>' name="reunions_ID">
                                <button type="submit" name="modifier" class="btn-primary btn-sm mx-3">modifier</button>
                                <button type="reset" class="btn-danger btn-sm">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Cotisation
                        </div>
                        <div class="card-body">
                            <form method="POST" action="#" class="form">
                                <table class="table table-striped table-bordered mt-4">
                                    <thead class="bg-light text-center">
                                        <th>Nom et prenom</th>
                                        <th>Montant cotiser</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($cotisation = $requette3->fetch()) {
                                            extract($cotisation);
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $nom . "  " . $prenom ?></br>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" min="0" max="<?php $montant_a_cotiser ?>" name="montant_cotiser[<?= $contenir_ID ?>]" class="form-control">
                                                    </div>
                                            </tr>
                                            </td>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="d-flex  align-items-center mt-1 mb-0">
                                    <input type="hidden" value='<?= $reunions["reunions_ID"] ?>' name="reunions_ID">
                                    <button type="submit" name="cotisation" class="btn-primary btn-sm mx-3">Enregistrer</button>
                                    <button type="reset" class="btn-danger btn-sm">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Enregistrement en caisse
                        </div>
                        <div class="card-body">
                            <form method="POST" action="#" class="form">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label">Selectionner la caisse : </label>
                                        <select class="form-control mt-2" name="caisses_ID">
                                            <?php
                                            while ($caisse = $query1->fetch()) {
                                                extract($caisse);
                                                echo "<option value='$caisses_ID'>$nom_caisse</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <table class="table table-striped table-bordered mt-4">
                                        <thead class="bg-light text-center">
                                            <th>Nom et prenom</th>
                                            <th>Montant cotiser</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($result = $requette4->fetch()) {
                                                extract($result);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= $nom . "  " . $prenom ?>
                                                        </br>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" min="0" name="montant_caisse[<?= $contenir_ID ?>]" class="form-control">
                                                        </div>
                                                </tr>
                                            <?php } ?>
                                            </td>
                                        </tbody>
                                    </table>
                                    <div class="d-flex  align-items-center mt-1">
                                        <input type="hidden" value='<?= $reunions["reunions_ID"] ?>' name="reunions_ID">
                                        <button type="submit" name="enregistrement_caisse" class="btn-primary btn-sm mx-3">Enregistrer</button>
                                        <button type="reset" class="btn-danger btn-sm">Annuler</button>
                                    </div>

                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Prets
                </div>
                <div class="card-body">
                    <form method="POST" action="#" class="form">
                        <div class="form-group">
                            <label class="form-label">Selectionner la caisse : </label>
                            <select class="form-control mt-2" name="caisses_ID">
                                <?php
                                while ($caisses = $query2->fetch()) {
                                    extract($caisses);
                                    echo "<option value='$caisses_ID'>$nom_caisse</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <table class="table table-striped table-bordered mt-4">
                            <thead class="bg-light text-center">
                                <th>Nom et prenom</th>
                                <th>Montant du pret</th>
                            </thead>
                            <tbody>
                                <?php
                                // $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                while ($pret = $requette5->fetch()) {
                                    extract($pret);
                                ?>
                                    <tr>
                                        <td>
                                            <?= $nom . "  " . $prenom ?>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" min="0" max="<?php $montant_a_cotiser ?>" name="montant_prets[<?= $contenir_ID ?>]" class="form-control">
                                            </div>
                                    </tr>
                                <?php } ?>
                                </td>
                            </tbody>
                        </table>
                        <div class="d-flex  align-items-center mt-1">
                            <input type="hidden" value='<?= $reunions["reunions_ID"] ?>' name="reunions_ID">
                            <button type="submit" name="prets" class="btn-primary btn-sm mx-3">Enregistrer</button>
                            <button type="reset" class="btn-danger btn-sm">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php
    include("../controller/reunions/traitement_modifier_reunions.php");
    include("_layout/footer.php");
    ?>