<div class="modal fade" id="modal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" aria_labelledby="modal-title">Ajouter une session de banque</h4>
            </div>
            <!-- <button class="btn btn-close" data-bs-dismiss="modal" aria-label="close"></button> -->
            <div class="modal-body" aria-describe="content">
                <form method="POST" action="../controller/session_banques/traitement_session_banques.php" class="form">
                    <div>
                        <div class="form-group">
                            <label for="date_ouverture">Date d'ouverture : </label>
                            <input type="date" id="date_ouverture" name="date_ouverture" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_fermeture">Date de fermeture : </label>
                            <input type="date" id="date_fermeture" name="date_fermeture" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Banque : </label>
                            <select class="form-control" name="banques_ID">
                                <?php
                                include_once("../../dbconfig/connexion.php");
                                $sql = "SELECT * FROM banques";
                                $requette = $bdd->prepare($sql);
                                $requette->execute();
                                $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                while ($result = $requette->fetch()) {
                                    extract($result);
                                    echo "<option value='$banques_ID'>$nom_banque</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="btn">
                    <button type="submit" name="enregistrer" class="btn-primary btn-sm">Enregistrer</button>
                    <button class="btn btn-danger btn-sm" type="button" role="button" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>