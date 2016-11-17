<div id="testmodal2" style="padding: 5px 20px;">
    <form id="antoform2" class="form-horizontal calender" role="form" method="POST" action="<?php echo base_url(); ?>Utilisateurs/update_adr">
        
        <div class="form-group">
                <input class="form-control" placeholder="Nom" name="nom" type="text" autofocus="" required>
        </div>
        <div class="form-group">
                <input class="form-control" placeholder="Prenom" name="prenom" type="text" value="" required>
        </div>
        <div class="form-group">
                <input class="form-control" placeholder="Numero" name="numero" type="phone" value="" required>
        </div>
        <div class="form-group">
                <input class="form-control" placeholder="Ville" name="ville" type="text" value="" required>
        </div>
                        
        <div class="form-group">
            <button type="submit" class="btn btn-primary" >Enregistrer</button>
            <button type="submit" class="btn btn-warning" data-dismiss="modal">Annuler</button>
        </div>
        
    </form>
</div>