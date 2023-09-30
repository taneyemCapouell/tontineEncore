<?php
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
                <li class="breadcrumb-item active">Ajouter une utilisateur</li>
            </ol>
            <?php include("./_partial/alert_message.php"); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Ajouter un utilisateur
                </div>
                <div class="card-body">
                    <?php include("./_partial/alert_message.php"); ?>
                    <form method="POST" action="../../controller/admin/traitement_users.php" class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titre">Nom :</label>
                                    <input type="text" id="nom" name="nom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="date_debut">Prenom :</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="mail">Email :</label>
                                    <input type="email" id="mail" name="mail" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="telephone">Telephone : </label>
                                    <input type="number" id="telephone" name="telephone" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="localisation">Localisation : </label>
                                    <input type="text" id="localisation" name="localisation" class="form-control mt-2">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="role">Role : </label>
                                    <select id="role" name="role" class="form-control mt-2">
                                        <option>Utilisateur</option>
                                        <option>Administrateur</option>
                                        <option>President</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="role">Genre : </label><br>
                                    <input type="radio" value="masculin" name="genre" class="form-check-input mt-3">
                                    <label class="form-input-label mt-3">Masculin</label>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input type="radio" value="feminin" name="genre" class="form-check-input mt-3">
                                    <label class="form-input-label mt-3">Feminin</label>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="date_nais">Date de naissance : </label>
                                    <input type="date" id="date_nais" name="date_nais" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="pass">Mot de passe : </label>
                                    <input type="password" id="pass" name="pass" class="form-control mt-2">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="confirmer">confirmer le mot de passe : </label>
                                    <input type="password" id="confirmer" name="confirmer" class="form-control mt-2">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="form-label">Association : </label>
                                <select class="form-control mt-2" name="associations_ID">
                                    <option value="0">0</option>
                                    <?php
                                    include_once("../../dbconfig/connexion.php");
                                    $sql = "SELECT * FROM associations";
                                    $requette = $bdd->prepare($sql);
                                    $requette->execute();
                                    $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($result = $requette->fetch()) {
                                        extract($result);
                                        echo "<option value='$associations_ID'>$nom</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="d-flex align-items-center mt-4 mb-0">
                                <button type="submit" name="enregistrer" class="btn-primary mx-4 btn-lg">Enregistrer</button>
                                <button type="reset" class="btn-danger btn-lg">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include("./_layout/footer.php") ?>