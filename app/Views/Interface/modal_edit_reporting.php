<div class="modal fade" id="modal_edit_reporting" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edition des données</h5>
            </div>
            <div class="modal-body" style="padding-right:30px;">
          <div class="row"  style="padding-left:30px;">
              <input type="hidden" id='route_edit_saisi' value="<?= route_to('show_saisie')?>">
              <input type="hidden" id='id_parametrage-edit'>
              <input type="hidden" class='repertoir' value='edit-rep'>
              <div class="form-group row col-sm-4" style="font-size: 1.4em;">
                <label class="col-sm-3" style="padding-top: 5px;">Date :</label>
                <select id="date_saisi_reporting-edit" class="form-control col-sm-8"> 
                  <option value="d">Egal à</option>
                  <option value="dd">Entre</option>
                  <option value="j" selected>Aujourd'hui</option>
                  <option value="s">Cette semaine</option>
                  <option value="1s">La semaine dernière</option>
                  <option value="m">Ce mois-ci</option>
                  <option value="1m">Le mois dernier</option>
                </select>
              </div>
              <div class="col-sm-2" id="date1-edit">
                  <input type="text" id="date_1-edit" class="form-control date_saisi">
              </div>
              <div class="col-sm-2" id="date2-edit" >
                  <input type="text" id="date_2-edit" class="form-control date_saisi">
              </div>
              <div>
                  <button type="button" class="btn btn-info form-control btn-search_date" data-mod="edit-rep" >
                    <span class="fa fa-search"></span>
                  </button>
              </div>
          </div>

          <div id="table_edit_interface">
            
          </div>
      </div>
      <div class="modal-footer">
            <div class="row" style="padding:0px 10px 0px 10px;">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary btn-sm btn-fermer_saisie" data-dismiss="modal"><span class="fa fa-check"></span>&nbsp;&nbsp;Valider</button>
                </div>
            </div>
            </form>
      </div>
        </div>
    </div>
</div>


<script>
  (function($){
			$.fn.datepicker.dates['fr'] = {
				days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
				daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
				daysMin: ["D", "L", "M", "M", "J", "V", "S"],
				months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
				monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
				today: "Aujourd'hui",
				monthsTitle: "Mois",
				clear: "Effacer",
				weekStart: 1,
				format: "dd-mm-yyyy"
			};
		}(jQuery));

    $('.date_saisi').datepicker({
			language: 'fr',
			autoclose: true,
			todayHighlight: true,
			calendarWeeks: true,
		})
</script>