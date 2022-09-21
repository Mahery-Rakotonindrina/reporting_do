<div class="modal fade" id="modal_visu_param" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Visualisation des paramétrages</h5>
      </div>
      <div class="modal-body" style="padding-right:5px;">
          <div class="row"  style="padding-left:30px;">
              <div class="form-group row col-sm-3" style="font-size: 1.4em;">
                <label class="col-sm-4" style="padding-top: 5px;">Client :</label>
                <input type="text" id="recherche_client" class="form-control col-sm-8"> 
              </div>
              <div class="form-group row col-sm-3" style="font-size: 1.4em;">
                <label class="col-sm-4" style="padding-top: 5px;">Projet :</label>
                <input type="text" id="recherche_projet" class="form-control col-sm-8">
              </div>
          </div>
          <div class="row">
            <input type="hidden" id="visu_param" value="<?= route_to("visu_param")?>">
            <div class="form-group row col-sm-2 ml-auto" style="padding-left:40px;">
              <div class="button-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle form-control " data-toggle="dropdown"><span class="fa fa-cog"> </span> Autres colonnes</span></button>
                <ul class="dropdown-menu" style="width: 800px;">
                  <div class="row">
                    <div class="col-sm-4" style="margin-left:10px">
                      <li><a data-value="" ><input class="check_column" value="date_creation" type="checkbox" disabled/>&nbsp;&nbsp;Date creation</a></li>
                      <li><a data-value="" ><input class="check_column" value="client" type="checkbox" disabled/>&nbsp;&nbsp;Client</a></li>
                      <li><a data-value="" ><input class="check_column" value="code" type="checkbox" checked/>&nbsp;&nbsp;Code Commande</a></li>
                      <li><a data-value="" ><input class="check_column" value="projet" type="checkbox" disabled/>&nbsp;&nbsp;Projet</a></li>
                      <li><a data-value="" ><input class="check_column" value="date_deb_app" type="checkbox"/>&nbsp;&nbsp;Date debut application</a></li>
                      <li><a data-value="" ><input class="check_column" value="date_fin_app" type="checkbox"/>&nbsp;&nbsp;Date fin application</a></li>
                      <li><a data-value="" ><input class="check_column" value="matricule" type="checkbox" checked/>&nbsp;&nbsp;Matricule</a></li> 
                    </div>

                    <div class="col-sm-4">
                      <li><a data-value="" ><input class="check_column" value="mail" type="checkbox"/>&nbsp;&nbsp;Mail Client</a></li>
                      <li><a data-value="" ><input class="check_column" value="unite" type="checkbox"/>&nbsp;&nbsp;Unite de Volume</a></li>
                      <li><a data-value="" ><input class="check_column" value="obj_cadence" type="checkbox"/>&nbsp;&nbsp;Objectif Cadence</a></li>
                      <li><a data-value="" ><input class="check_column" value="t_occup" type="checkbox"/>&nbsp;&nbsp;Taux d'occupation</a></li>
                      <li><a data-value="" ><input class="check_column" value="dmt" type="checkbox"/>&nbsp;&nbsp;DMT</a></li>
                      <li><a data-value="" ><input class="check_column" value="rel_init" type="checkbox"/>&nbsp;&nbsp;Reliquat Initial</a></li>
                      <li><a data-value="" ><input class="check_column" value="obj_del_med" type="checkbox"/>&nbsp;&nbsp;Objectif délai median</a></li>
                      
                    </div>
                    <div class="col-sm-3">
                      <li><a data-value="" ><input class="check_column" value="obj_del_moy" type="checkbox"/>&nbsp;&nbsp;Objectif délai moyen</a></li>
                      <li><a data-value="" ><input class="check_column" value="t_resp_del" type="checkbox"/>&nbsp;&nbsp;Taux respect délai</a></li>
                      <li><a data-value="" ><input class="check_column" value="t_resp_del_2" type="checkbox"/>&nbsp;&nbsp;2ème Taux respect délai</a></li>
                      <li><a data-value="" ><input class="check_column" value="t_controle" type="checkbox"/>&nbsp;&nbsp;Taux de contrôle</a></li>
                      <li><a data-value="" ><input class="check_column" value="t_conf" type="checkbox"/>&nbsp;&nbsp;Taux de conformité</a></li>
                      <li><a data-value="" ><input class="check_column" value="graph" type="checkbox"/>&nbsp;&nbsp;Graphe</a></li>
                      <li><a data-value="" ><input class="check_column" value="statut" type="checkbox" checked/>&nbsp;&nbsp;statut</a></li>
                    </div>
                  </div>
                 
                 
                </ul>
              </div>
            </div>
          </div>
          
          <div id="liste_parametrage">

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
				format: "dd/mm/yyyy"
			};
		}(jQuery));



		$('#datepicker3').datepicker({
			language: 'fr',
			autoclose: true,
			todayHighlight: true,	
			calendarWeeks: true,
		})

		$('#datepicker4').datepicker({
			language: 'fr',
			autoclose: true,
			todayHighlight: true,
			calendarWeeks: true,
		})

</script>