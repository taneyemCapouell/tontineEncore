
<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$caisses_ID =$_GET["id"];
$sql = "SELECT * FROM  caisses where caisses_ID= $caisses_ID";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$caisses = $requette -> fetch();

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES CAISSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Caisses</li>
                <li class="breadcrumb-item active">Details de la caisse</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de la caisse
                </div>
                <div class="card-body">
                <p>ID :<?= $caisses["caisses_ID"] ?></p>
                <hr>
                <p>Nom de la caisse :<?= $caisses["nom_caisse"] ?></p>          
                <hr>                     
                <p>Description de la caisse :<?= $caisses["description"] ?></p>
                <hr>
                <p>
                    <a class="btn btn-primary" href="caisses_liste.php?id=<?=  $caisses["caisses_ID"]?>">Retour</a>
                    <a class="btn btn-warning" href="caisses_modifier.php?id=<?=  $caisses["caisses_ID"] ?>">Modifier</a>
                </p>
                </div>
            </div>
        </div>
    </main>

<?php include("./_layout/footer.php") ?>
