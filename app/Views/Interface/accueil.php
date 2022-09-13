<div class="table table-condensed">
    <input class="route_acc" type="hidden" value="<?= route_to('liste_reporting')?>">
    <input id="route_param" type="hidden" value="<?= route_to('get_parameter')?>">
   
    <div class="card">
        <div class="card-body">
            <div class="row" style="margin-top:30px; margin-left:30px;">
              <label class="col-sm-2"> Principal :</label>
              <div class="col-sm-3"></div>
              <button class="btn btn-primary col-sm-2" id="visu_saisie" title="visualiser saisie" data-toggle="modal" data-target="#modal_visu_saisie">Visu Saisie</button>
              <div class="col-sm-1"></div>
              <button id="btn-visu_param" class="btn btn-primary col-sm-2" title="visualiser paramétrages" data-toggle="modal" data-target="#modal_visu_param">Visu Paramétrage</button> 
              <div class="col-sm-1"></div>
              <button type="button" id="btn-new_param" class="btn btn-primary" title="ajouter nouveaux parametrage" data-toggle="modal" data-target="#modal_param">
                <span class="fa fa-plus"></span>
            </button> 

            </div>

            <div id="liste_reporting" style="margin-top:30px">

            </div>
        </div>
    </div>
</div>

<?php include('new_param.php');?>

