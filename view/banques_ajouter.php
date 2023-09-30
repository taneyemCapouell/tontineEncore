<div class="modal fade" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" aria_labelledby="modal-title">Ajouter une banque</h4>
            </div>
            <div class="modal-body" aria-describe="content">
                <form method="POST" action="../controller/banques/traitement_banques.php" class="form">
                    <div>
                        <div class="form-group mt-2">
                            <label for="nom_banque">Nom : </label>
                            <select class="form-control mt-2" id="statu" name="nom_banque" >
                                <option value="Banque annuelle">Banque annuelle</option>
                                <option value="Banque scolaire">Banque scolaire</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="montant_max">Montant maximun : </label>
                            <input type="number" id="montant_max" name="montant_max" class="form-control mt-2">
                        </div>

                        <div class="form-group mt-2">
                            <label for="montant_min">Montant minimun : </label>
                            <input type="number" id="montant_min" name="montant_min" class="form-control mt-2">
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