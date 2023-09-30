
<?php     
// on se connecte a la base de donnees
include_once("../../dbconfig/connexion.php");
$users_ID =$_GET["id"];
$sql = "SELECT * FROM  users where users_ID = $users_ID";

// on prepare le requette
$requette = $bdd -> prepare($sql);

// on execute la requette
$requette -> execute();

// on stoque le resultat dans un tableau associatif
$users = $requette -> fetch();

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
                <li class="breadcrumb-item active">Details de l'utilisateur</li>
            </ol>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Detail de l'utilisateur
                </div>
                <div class="card-body">
                <p>ID : <?= $users["users_ID"] ?></p>
                <hr>
                <p>Nom : <?= $users["nom"] ?></p>
                <hr>
                <p>Prenom : <?= $users["prenom"] ?></p>
                <hr>
                <p>Email : <?= $users["email"] ?></p>
                <hr>
                <p>Telephone : <?= $users["telephone"] ?></p>
                <hr>
                <p>Localisation : <?= $users["localisation"] ?></p>
                <hr>
                <p>Date de naissance : <?= $users["date_nais"] ?></p>
                <hr>
                <p>Genre : <?= $users["genre"] ?></p>
                <hr>
                <p>Role : <?= $users["role"] ?></p>
                <hr>
                <p>
                    <a class="btn btn-primary btn-lg" href="users_liste.php?id=<?=$users["users_ID"]?>">Retour</a>
                    <a class="btn btn-warning btn-lg" href="./users_modifier.php?id=<?=$users["users_ID"] ?>">Modifier</a>
                </p>
                </div>
            </div>
        </div>
    </main>

<?php include("./_layout/footer.php") ?>
