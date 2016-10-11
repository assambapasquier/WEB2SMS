
<div class="login-panel panel panel-default">
        <div class="panel-heading">Log in</div>
        <div class="panel-body">
               
                <p id="ret">
                        
                </p>
                
               <form  id="form_login" method="POST" action="<?php echo base_url() ?>Utilisateurs/login">
                        <fieldset>
                                <div class="form-group">
                                        <input class="form-control" placeholder="login" name="login" type="text" autofocus="">
                                </div>
                            
                                <?php echo form_error('password'); ?>
                            
                                <div class="form-group">
                                        <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
                                </div>
                                
                                <?php echo form_error('password'); ?>
                            
                                <div class="checkbox">
                                        <label>
                                                <input name="remember" type="checkbox" value="Remember Me">Se souvenir de moi
                                        </label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
                        </fieldset>
                </form>
        </div>
</div>
