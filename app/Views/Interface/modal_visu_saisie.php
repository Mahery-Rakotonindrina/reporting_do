<div class="modal fade" id="modal_visu_saisie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Visualisation des saisies</h5>
      </div>
      <div class="modal-body" style="padding-right:5px;">
          <div class="row"  style="padding-left:30px;">
              <div class="form-group row col-sm-3" style="font-size: 1.4em;">
                <label class="col-sm-4" style="padding-top: 5px;">Client :</label>
                <input type="text" id="recherche_visu_client" class="form-control col-sm-8"> 
              </div>
              <div class="form-group row col-sm-3" style="font-size: 1.4em;">
                <label class="col-sm-4" style="padding-top: 5px;">Projet :</label>
                <input type="text" id="recherche_visu_projet" class="form-control col-sm-8">
              </div>
          </div>
          
          <div id="liste_saisie">

          </div>
      </div>
      <div class="modal-footer">
            <div class="row" style="padding:0px 10px 0px 10px;">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;&nbsp;Fermer</button>
                </div>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>