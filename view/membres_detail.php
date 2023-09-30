
<?php     
// on se connecte a la base de donnees
include_once("../dbconfig/connexion.php");
$membres_ID =$_GET["id"];
$sql = "SELECT * FROM  membres where membres_ID=$membres_ID";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$membres = $requette -> fetch();

include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES MEMBRES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Membres</li>
                <li class="breadcrumb-item active">Detail d'un membres</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Details du membre
                </div>
                <div class="card-body">
                    <hr>
                <p>N_o :<?= $membres["membres_ID"] ?></p>
                <hr>
                <p>Nom : <?= $membres["nom"] ?></p>
                <hr>
                <p>Prenom : <?= $membres["prenom"] ?></p>
                <hr>
                <p>Email : <?= $membres["email"] ?></p>
                <hr>
                <p>Telephone  : <?= $membres["telephone"] ?></p>
                <hr>
                <p>Ville : <?= $membres["ville"] ?></p>
                <hr>
                <p>Genre : <?= $membres["genre"] ?></p>
                <hr>
                <p>Fond  : <?= $membres["fond"] ?></p>
                <hr>
                <p>Date de naissance : <?= $membres["date_nais"] ?></p>
                <hr>
                <p>Statut du membre : <?= $membres["statu"] ?></p>
                <hr>
                <p>
                    <a class="btn btn-primary" href="membres_liste.php?id=<?=$membres["membres_ID"]?>">Retour</a>
                    <a class="btn btn-warning" href="membres_modifier.php?id=<?=$membres["membres_ID"] ?>">Modifier</a>
                </p>
                </div>
            </div>
        </div>
    </main>

<?php include("./_layout/footer.php") ?>
