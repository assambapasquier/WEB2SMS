<!--<div class="panel panel-default">
    <div class="panel-heading"><small>Ajouter un contact dans le carnet d'adresse</small></div>
<div class="panel-body">-->
<form role="form" id="form_add_contact" method="POST" action="<?php echo base_url() ?>Utilisateurs/import_contacts" enctype="multipart/form-data">
        <fieldset>
                <div class="form-group">
                        <label>Importer depuis un fichier CSV</label>
                        <input type="file" accept=".csv" name="csv">
                         <!--<p class="help-block">Example block-level help text here.</p>-->
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-primary" enabled>Importer</button>
                        
                </div>
        </fieldset>
</form>
<!--</div>-->