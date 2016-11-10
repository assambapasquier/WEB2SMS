<div class="panel panel-default">
        <div class="panel-heading" style="color:rgb(0,132,232);">Créer un nouveau message</div>
        <?php
            if(isset($message_sent) && $message_sent!==null){
                if($message_sent == "KO"){
                    echo '<div class="alert alert-dismissable alert-danger"><small>Echec d\'envoi du message. Veuillez reessayer SVP</small></div>';
                }
            }
       ?>
        <div class="panel-body" style="background-color:rgb(255,255,255);">
                <div class="col-md-12">
                        <form role="form" method="POST" id = "form_saisir_message" action="<?php echo base_url(); ?>Utilisateurs/envoyer_messages">
                                <div class="form-group">
                                    <label>Destinataire (saisir en les séparant par des ";") <br/> <small>Ne pas mettre l'indicatif du pays</small></label>
                                        <div class="row">
                                                <div class="col-md-10">
                                                        <?php 
                                                            $l = 0;
                                                            echo '<input type="phone" name="destinataire" class="form-control" value="';
                                                            if(isset($contacts_envoi)){
                                                                foreach ($contacts_envoi as $v1) {
                                                                    if($v1!==array()){
                                                                        $l = $l+1;
                                                                        if($l==sizeof($contacts_envoi)) echo $v1;
                                                                        else echo $v1.';';
                                                                    }     
                                                                }
                                                            }
                                                            echo'">';
                                                            //var_dump($contacts_envoi);
                                              
                                                        ?>
                                                        
                                                </div>
                                            <a data-toggle="modal" data-target="#modal_select_contacts">
                                                <div class="col-md-2">
                                                        <i class="fa fa-book fa-2x"></i>
                                                </div>
                                            </a>
                                        </div>

                                </div>

                                <div class="form-group">
                                        <label>Groupe (s) (saisir en les séparant par des ";")</label>
                                        <div class="row">
                                                <div class="col-md-10">
                                                        
                                                         <?php 
                                                            //var_dump($groupes_envoi);
                                                            $l = 0;
                                                            echo '<input type="text" class="form-control" name="groupe" value="';
                                                            if(isset($groupes_envoi)){
                                                                foreach ($groupes_envoi as $v1) {
                                                                    if($v1!==array()){
                                                                        $l = $l+1;
                                                                        if($l==sizeof($groupes_envoi)) echo $v1;
                                                                        else echo $v1.';';
                                                                    }     
                                                                }
                                                            }
                                                            echo'">';
                                                            //var_dump($contacts_envoi);
                                              
                                                        ?>
                                                </div>
                                                <a data-toggle="modal" data-target="#modal_select_groups">
                                                    <div class="col-md-2">
                                                            <i class="fa fa-users fa-2x"></i>
                                                    </div>
                                                </a>
                                        </div>

                                </div>
                            
                                <div class="form-group">
                                    <label>Objet du message</label>

                                    <input class="form-control" placeholder="objet du message" name="objet">
                                </div>

                                <!--<div class="form-group checkbox">
                                  <label>
                                    <input type="checkbox">Remember me</label>
                                </div>-->

                                <div class="form-group">
                                        <label>Importer un fichier CSV</label>
                                        <input type="file" name="csv">
                                         <!--<p class="help-block">Example block-level help text here.</p>-->
                                </div>

                                <div class="form-group">
                                        <label>Saisir votre Message ici</label>
                                        <textarea class="form-control" rows="6" name="message"></textarea>
                                </div>
                                
                                <div class="form-group">
                                        <label>Signature</label>
                                        <select class="form-control" name="signature">
                                            <?php
                                            foreach ($signatures as $v1) {
                                                if($v1!==array()){
                                                    echo '<option value="'.$v1['id'].'">'.$v1['libelle'].'</option>';
                                                }
                                            }
                                            ?>
                                            
                                        </select>
                                </div>

                                
                                
                                <div class="form-group">
                                        <input type="checkbox" id="yourBox" onclick="document.getElementById('yourBox').onchange = function() {
                                            document.getElementById('progr').disabled = !this.checked;
                                            document.getElementById('date_prog').disabled = !this.checked;
                                            document.getElementById('heure_prog').disabled = !this.checked; 
                                            document.getElementById('env').disabled = this.checked;
                                        };"/> Programmer l'envoi? (cocher)
                                        <input class="form-control" name="progr_date" id="date_prog" type="date" disabled />
                                        <input class="form-control" name="progr_time" id="heure_prog" type="time" disabled />
                                </div>
                                
                                <div class="form-group">
                                        <button type="submit" id="env" class="btn btn-primary" name="action" value="envoyer" enabled>Envoyer le message</button>
                                        <button type="submit" id="progr" class="btn btn-warning" name="action" value="programmer" disabled >Programmer l'envoi</button>
                                        <button type="reset" class="btn btn-default">Effacer</button>
                                </div>

                        </div>

                </form>
        </div>
</div>