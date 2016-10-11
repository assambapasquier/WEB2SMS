<!-- Modal -->
<div class="modal fade bs-modal-sm" id="modal_select_contacts" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <br>
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#register" data-toggle="tab">Choisir un contact</a></li>
              <li class=""><a href="#why" data-toggle="tab">Pourquoi?</a></li>
            </ul>
        </div>
      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
            
            <div class="tab-pane fade active in" id="register">
                <?php include('form_choix_contacts.php'); ?>
            </div>
            
            <div class="tab-pane fade in" id="why">
            <p>Cela facilitera l'envoi du message à plusieurs personnes</p>

            </div>

        </div>
      </div>
      <div class="modal-footer">
        <center>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </center>
      </div>
    </div>
  </div>
</div>