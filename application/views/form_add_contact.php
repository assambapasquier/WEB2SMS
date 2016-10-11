<!--<div class="panel panel-default">
    <div class="panel-heading"><small>Ajouter un contact dans le carnet d'adresse</small></div>
<div class="panel-body">-->
        <form role="form" id="form_add_contact" method="POST" action="<?php echo base_url() ?>feature/accueil/add_contact">
                <fieldset>
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
                                <input class="form-control" placeholder="Groupe" name="groupe" type="text" value="">
                        </div>
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter le contact</button>
                                <button class="btn btn-lg btn-danger btn-block" type="reset">Effacer</button>
                        </div>

                </fieldset>
        </form>
<!--</div>-->