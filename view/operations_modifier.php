<?php
if ($_POST) {
    if (
        isset($_POST["sessionss_ID"]) && !empty($_POST["sessionss_ID"])
        && isset($_POST["titre"]) && !empty($_POST["titre"])
        && isset($_POST["date_debut"]) && !empty($_POST["date_debut"])
        && isset($_POST["date_fin"]) && !empty($_POST["date_fin"])
        && isset($_POST["type_bouffe"]) && !empty($_POST["type_bouffe"])
        && isset($_POST["durree_session"]) && !empty($_POST["durree_session"])
    ) {

        // on se connecte a la base de donnees
        require_once("../dbconfig/connexion.php");

       // on recupere les donnees en les protegeant
       $titre = strip_tags($_POST["titre"]);
       $date_debut = strip_tags($_POST["date_debut"]);
       $date_fin = strip_tags($_POST["date_fin"]);
       $type_bouffe = strip_tags($_POST["type_bouffe"]);
       $durree_session = strip_tags($_POST["durree_session"]);
       $sessionss_ID = strip_tags($_POST["sessionss_ID"]);



        // on insere les donnees dans la base de donnees
        $sql = 'UPDATE sessionss  SET titre=:titre , date_debut=:date_debut ,date_fin=:date_fin, 
        type_bouffe=:type_bouffe , durree=:durree_session WHERE sessionss_ID=:sessionss_ID;';
  
        // on prepare la requette 
        $requette = $bdd->prepare($sql);
        $requette->bindValue(":titre", $titre);
        $requette->bindValue(":date_debut", $date_debut);
        $requette->bindValue(":date_fin", $date_fin);
        $requette->bindValue(":type_bouffe", $type_bouffe);
        $requette->bindValue(":durree_session", $durree_session);
        $requette->bindValue(":sessionss_ID", $sessionss_ID);
        $requette->execute();

        $_SESSION['message'] = "Session modifier";
        $_SESSION['status'] = "success";
        header("location:./session_liste.php");
        exit;
        require_once("../dbconfig/deconnexion.php");
    } else {
        $_SESSION['message'] = 'Formulaire incomplet';
        $_SESSION['status'] = 'danger';
        header("location:session_modifier.php");
        exit;
    }
}

// on verifie si l'id existe et n'est pas vide dans l'url
if (isset($_GET["id"]) && !empty($_GET["id"])){
    require_once("../dbconfig/connexion.php");

    // on netoie d'id envoyer
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM sessionss WHERE sessionss_ID = :sessionss_ID";

    // on prepare la requette 
    $requette = $bdd->prepare($sql);

    // on accroche les parametres
    $requette->bindValue(':sessionss_ID', $id, PDO::PARAM_INT);

    // on execute la requette 
    $requette->execute();

    // on recupere le produit(resultat de la requette)
    $sessions = $requette->fetch();

    // on verifie si l'id existe 
    if (!$sessions) {
        $_SESSION['message'] = "Cet id n'existe pas";
        $_SESSION['status'] = "danger";
        header("location:session_liste.php");
        exit;
    }
} else {
    $_SESSION['message'] = "URL INVALIDE";
    $_SESSION['status'] = "danger";
    header("location:session_liste.php ");
    exit;
}
include("./_layout/header.php");
include("./_layout/sidebar.php");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <p class="mt-4">GESTION DES LICENSES</p>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item ">Tableau de bord</li>
                <li class="breadcrumb-item ">Sessions</li>
                <li class="breadcrumb-item active">Modifier une session</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier une session
                </div>
                <?php include("./_partial/alert_message.php") ?>
                <div class="card-body">
                    <form method="POST" class="form">
                        <div>
                            <div class="form-group">
                                <label for="titre">Titre de la session :</label>
                                <input type="text" id="titre" value='<?= $sessions["titre"] ?>' name="titre" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="date_debut">Date de debut :</label>
                                <input type="date" id="date_debut" value='<?= $sessions["date_debut"] ?>' name="date_debut" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="date_fin">Date de fin :</label>
                                <input type="date" id="nombre" value='<?= $sessions["date_fin"] ?>' name="date_fin" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="type_bouffe">Type bouffe : </label>
                                <input type="text" id="type_bouffe" value='<?= $sessions["type_bouffe"] ?>' name="type_bouffe" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="durree_session">Durree de la session : </label>
                                <input type="number" id="durree_session" value='<?= $sessions["durree"] ?>' name="durree_session" class="form-control">
                            </div>

                            <div class="btn">
                                <input type="hidden" value="<?= $sessions["sessionss_ID"] ?>" name="sessionss_ID">
                                <button type="submit" class="btn-primary  btn-lg">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("_layout/footer.php") ?>