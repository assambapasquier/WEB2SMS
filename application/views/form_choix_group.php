<form role="form" id="form_add_group" method="POST" action="<?php echo base_url() ?>Utilisateurs/nouveau_message">
    <fieldset>
        
           <?php 
            foreach ($groupes as $v1){
                   if($v1!==array()){
                    echo ' <div class="checkbox">
                             <label>';
                                 echo '<input type="checkbox" value="'.$v1['idGroupe'].'" name="groupes[]">'.$v1['libelleGroupe'];
                     echo ' </label>
                     </div>';  
                   }
            }
           ?>
            
            <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" nane="action" value="choix_contact">Valider</button>
                    <button class="btn btn-lg btn-danger btn-block" type="reset">Désélectionner</button>
            </div>

    </fieldset>
</form>