<div class="panel panel-default">
        <div class="panel-heading"><span style="color:rgb(0,132,232);">Vos contacts</span> &nbsp;&nbsp;&nbsp;<button type="button" class=" fa fa-plus btn btn-primary" data-toggle="modal" data-target="#modal_add_contact">&nbsp;Ajouter</button>
                <p id="ret">  
                    
                </p>
        </div>
        <div class="panel-body">
                <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                    <tr>
                        <th data-field="state" data-checkbox="true" ></th>
                        <th data-field="id" style="display:none">ID</th>
                        <th data-field="nom" data-sortable="true"><span style="color:rgb(0,132,232);">Noms</span></th>
                        <th data-field="prenom"  data-sortable="true"><span style="color:rgb(0,132,232);">Prenoms</span></th>
                        <th data-field="tel1" data-sortable="true"><span style="color:rgb(0,132,232);">Tel1</span></th>
                        <th data-field="ville" data-sortable="true"><span style="color:rgb(0,132,232);">Villes</span></th>
                        <th data-field="groupe" data-sortable="true"><span style="color:rgb(0,132,232);">Groupes</span></th>
                        <th data-field="action" data-sortable="true"><span style="color:rgb(0,132,232);">Actions</span></th>
                    </tr>
                    </thead>
                    <!--foreach ($a as $v1) {
                        foreach ($v1 as $v2) {
                            echo "$v2\n";
                        }
                    }-->
                    
                        <tbody>
                            <?php foreach ($contacts as $v1) {
                                    echo '<tr>';
                                        echo '<td></td>';
                                       foreach ($v1 as $v2) {
                                           echo '<td>'.$v2.'</td>';
                                       }
                                        if($v1!==array()){
                                       echo '<td class="center">
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