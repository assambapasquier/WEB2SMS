<form role="form" id="form_add_group" method="POST" action="<?php echo base_url() ?>feature/accueil/selection_contacts">
    <fieldset>
        
           <?php 
            foreach ($destinataires as $v1){
               
                   echo ' <div class="checkbox">
                            <label>';
                                    echo '<input type="checkbox" value="'.$v1['numero'].'" name="contacts[]">'.$v1['nom'];
                    echo ' </label>
                    </div>';       
             
            }
           ?>
            
            <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter Les contacts</button>
                    <button class="btn btn-lg btn-danger btn-block" type="reset">Désélectionner</button>
            </div>

    </fieldset>
</form>