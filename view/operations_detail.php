
<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");

$sql = "SELECT * FROM  sessionss";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$session = $requette -> fetch();

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
                <p>ID :<?= $session["sessionss_ID"] ?></p>
                <p>Titre de la session :<?= $session["titre"] ?></p>
                <p>Date de debut :<?= $session["date_debut"] ?></p>
                <p>Date de fin :<?= $session["date_fin"] ?></p>
                <p>Durree de la session :<?= $session["durree"] ?></p>
                <p>Type de bouffe :<?= $session["type_bouffe"] ?></p>
                <p>
                    <a class="btn btn-primary" href="session_liste.php?id=<?=  $session["sessionss_ID"]?>">Retour</a>
                    <a class="btn btn-warning" href="session_modifier.php?id=<?=  $session["sessionss_ID"] ?>">Modifier</a>
                </p>
                </div>
            </div>
        </div>
    </main>

<?php include("./_layout/footer.php") ?>
