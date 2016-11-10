<div class="panel panel-default">
    <div class="panel-heading"><span style="color:rgb(0,132,232);">Vos Différents groupes</span> &nbsp;&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#modal_add_group" class="fa fa-plus btn btn-primary">&nbsp;Ajouter</button>
        <div id="ret">

        </div>
    
    </div>
                
    
    <div class="panel-body">
            <?php 
                $trouve = false;
                foreach ($groupes as $v1) {
                    if($v1!==array()){
                        $trouve = 1;
                        echo '<div class="row">
                            <div class="panel panel-blue panel-widget ">
                                    <!--<a href="#">-->
                                    <div class="row no-padding">
                                            <div class="col-sm-5 col-lg-5 widget-left">
                                                    <span><strong>'; echo $v1['libelleGroupe']; echo' </strong></span><br/><small>'; echo $v1['description']; echo '</small>
                                            </div>
                                            <div class="col-sm-5 col-lg-5 widget-center">
                                                    
                                                    <div class="text-muted"><strong><span style="color:black;">'; $n = explode('_', $v1['idGroupe']); echo '<h3 style="color:red">'.$n[1].'</h3>';
                                                    echo '<small>Contacts</small></span></strong></div>
                                            </div>
                                            <div class="col-sm-2 col-lg-2">
                                                <a class="btn btn-link" class="buton-del" title="modifier le groupe" onclick="alert("sometext");"><i class="fa fa-edit fa-fw" class="buton-del"></i></a>
                                                <a class="btn btn-link" class="buton-del" title="supprimer le groupe"><i class="fa fa-times fa-fw" class="buton-del"></i></a>
                                            </div>
                                            
                                    </div>
                                   <!-- </a>-->
                            </div>
                        </div><!--end row--> ';
                    }
                }
                if(!$trouve){//aucun groupe présent ?>
                    <div class="row">
                            <div class="panel panel-red panel-widget ">
                                    <div class="row no-padding">
                                            <div class="col-sm-6 col-lg-6 widget-left">
                                                    <span> Aucun groupe trouvé!</span>
                                            </div>
                                            <div class="col-sm-6 col-lg-6 widget-right">
                                                    <div class="large">12</div>
                                                    <div class="text-muted"><strong><span style="color:black;"><small>Contacts</small></span></strong></div>
                                            </div>
                                    </div>
                            </div>
                    </div><!--end row--> 
                <?php } ?>
                    
    </div>
</div>