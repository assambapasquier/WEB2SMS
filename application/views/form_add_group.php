<!--<div class="panel panel-default">
    <div class="panel-heading">Ajouter un contact dans le carnet d'adresse</div>
    <div class="panel-body">-->
            <form role="form" id="form_add_group" method="POST" action="<?php echo base_url() ?>Utilisateurs/add_group">
                    <fieldset>
                            <div class="form-group">
                                    <input class="form-control" placeholder="Nom du groupe" name="nom" type="text" autofocus="">
                            </div>
                        
                            <div class="form-group">
                                    <input class="form-control" placeholder="Description du groupe" name="description" type="text" autofocus="">
                            </div>

                            <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter le groupe</button>
                                    <button class="btn btn-lg btn-danger btn-block" type="reset">Annuler l'ajout</button>
                            </div>

                    </fieldset>
            </form>
    <!--</div>
</div>-->