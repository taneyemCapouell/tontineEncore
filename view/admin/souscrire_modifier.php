<div class="modal fade" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" aria_labelledby="modal-title">Ajouter une banque</h4>
            </div>
            <div class="modal-body" aria-describe="content">
                <form method="POST" action="../controller/souscrire/traitement_souscrire.php" class="form">
                    <div>
                        <div class="form-group">
                            <label for="date_souscription">Date de souscription : </label>
                            <input type="date" id="date_souscription" value='<?= $associations["date_souscription"] ?>' name="date_souscription" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">License : </label>
                            <select class="form-control" name="license_ID">
                                <option value="0">0</option>
                                <?php
                                include_once("../../dbconfig/connexion.php");
                                $sql = "SELECT * FROM license";
                                $requette = $bdd->prepare($sql);
                                $requette->execute();
                                $result1 = $requette->setFetchMode(PDO::FETCH_ASSOC);
                                while ($result = $requette->fetch()) {
                                    extract($result);
                                    echo "<option value='$license_ID'>$nom</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                                <label class="form-label">Association : </label>
                                <select class="form-control" name="associations_ID">
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
                    </div>
                    <div class="modal-footer">
                        <div class="btn">
                            <button type="submit" name="enregistrer" class="btn-primary btn-sm">Envoyer</button>
                            <button class="btn btn-danger btn-sm" type="button" role="button" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>