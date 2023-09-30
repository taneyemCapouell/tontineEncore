<div class="modal fade" id="modal1<?= $banques["banques_ID"]?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" aria_labelledby="modal-title">Modifier une banque</h4>
            </div>
            <div class="modal-body" aria-describe="content">
                <form method="POST" action="../controller/banques/traitement_banques.php" class="form">
                    <div>
                        <div class="form-group">
                            <label for="nom_banque<?= $banques["banques_ID"]?>">Nom de la banque : </label>
                            <input type="text" id="nom_banque<?= $banques["banques_ID"] ?>" name="nom_banque" value="<?= $banques["nom_banque"] ?>" class="form-control mt-2">
                        </div>

                        <div class="form-group mt-2">
                            <label for="montant_max<?= $banques["banques_ID"] ?>">Montant maximun : </label>
                            <input type="number" id="montant_max<?= $banques["banques_ID"] ?>" name="montant_max" value="<?= $banques["montant_max"] ?>" class="form-control mt-2">
                        </div>

                        <div class="form-group mt-2">
                            <label for="montant_min<?= $banques["banques_ID"] ?>">Montant minimun : </label>
                            <input type="number" id="montant_min<?= $banques["banques_ID"] ?>" value="<?= $banques["montant_min"] ?>" name="montant_min" class="form-control mt-2">
                        </div>
                    </div>
                    <div class="modal-footer" id="montant_min<?= $banques["banques_ID"] ?>" value="<?= $banques["montant_min"]?>">
                        <div class="btn">
                            <input type="hidden" name="banques_ID" value="<?= $banques["banques_ID"] ?>">
                            <button type="submit" name="modifier" class="btn-primary btn-sm">Modifier</button>
                            <button class="btn btn-danger btn-sm" type="button" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
