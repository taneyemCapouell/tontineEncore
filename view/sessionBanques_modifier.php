<div class="modal fade" id="modal2<?= $session_banques["session_banques_ID"]?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" aria_labelledby="modal-title">Modifier une session de banque</h4>
            </div>
            <!-- <button class="btn btn-close" data-bs-dismiss="modal" aria-label="close"></button> -->
            <div class="modal-body" aria-describe="content">
                <form method="POST" action="../controller/session_banques/traitement_session_banques.php" class="form">
                    <div>
                        <div class="form-group">
                            <label for="montant_max<?= $session_banques["session_banques_ID"] ?>">Montant maximun : </label>
                            <input type="number" id="montant_max<?= $session_banques["session_banques_ID"] ?>" name="montant_max" value="<?= $banques["montant_max"] ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="montant_min<?= $session_banques["session_banques_ID"] ?>">Montant minimun : </label>
                            <input type="number" id="montant_min<?= $session_banques["session_banques_ID"] ?>" name="montant_min" value="<?= $banques["montant_min"] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn">
                            <input type="hidden" name="session_banques_ID" value="<?= $session_banques["session_banques_ID"] ?>">
                            <button type="submit" name="modifier" class="btn-primary btn-sm">Modifier</button>
                            <button class="btn btn-danger btn-sm" type="button" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>