<div class="panel panel-default">
    <div class="panel-heading"><span style="color:rgb(0,132,232);">Boite d'envoi</span> 
        &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?>feature/accueil/new_message"><button type="button" class="fa fa-plus btn btn-primary">&nbsp;Nouveau Message</button></a>
    </div>
    <div class="panel-body">
            <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                <thead>
                <tr>
                    <th data-field="state" data-checkbox="true" ></th>
                    <th data-field="date" data-sortable="true"><span style="color:rgb(0,132,232);">Dates</span></th>
                    <th data-field="objet"  data-sortable="true"><span style="color:rgb(0,132,232);">Objets</span></th>
                    <th data-field="message" data-sortable="true"><span style="color:rgb(0,132,232);">Messages</span></th>
                            <th data-field="statut" data-sortable="true"><span style="color:rgb(0,132,232);">Statuts</span></th>
                            <th data-field="Action" data-sortable="true"><span style="color:rgb(0,132,232);">Actions</span></th>
                </tr>
                </thead>

                    <tbody>
                        <?php foreach ($messages as $v1) {
                                echo '<tr>';
                                    echo '<td></td>';
                                   foreach ($v1 as $v2) {
                                       echo '<td>'.$v2.'</td>';
                                   }
                                   if($v1!==array()){
                                   echo '<td class="center">
                                            <a class="btn btn-link" title="envoyer de nouveau"><i class="fa fa-paper-plane fa-fw"></i></a>
                                            <a class="btn btn-link" class="buton-del" title="supprimer"><i class="fa fa-times fa-fw" class="buton-del"></i></a>
                                        </td>';
                                   }
                                echo '</tr>';
                            }
                        ?>
                        
                    </tbody>
            </table>
    </div>
</div>