
<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$sanctions_ID =$_GET["id"];

$sql = "SELECT * FROM  sanctions where sanctions_ID = $sanctions_ID";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$sanctions = $requette -> fetch();

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES SANCTIONS</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Sanctions</li>
                <li class="breadcrumb-item active">Details de la sanction</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la sanction
                </div>
                <div class="card-body">
                <p>ID : <?= $sanctions["sanctions_ID"] ?></p>
                <p>Cause : <?= $sanctions["cause"] ?></p>
                <p>Montant : <?= $sanctions["montant"] ?></p>
                <p>Delait : <?= $sanctions["delait"] ?></p>
                <p>Statut : <?= $sanctions["statu"] ?></p>
                <p>
                    <a class="btn btn-primary" href="sanctions_liste.php?id=<?=$sanctions["sanctions_ID"]?>">Retour</a>
                    <a class="btn btn-warning" href="sanctions_modifier.php?id=<?=$sanctions["sanctions_ID"] ?>">Modifier</a>
                </p>
                </div>
            </div>
        </div>
    </main>

<?php include("./_layout/footer.php") ?>
