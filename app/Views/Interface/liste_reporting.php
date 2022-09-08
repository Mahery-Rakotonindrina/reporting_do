<table class="table table-striped tableFixHead" id="Table_data">
    <thead>
        <tr class="center text-center">
            <th class="col-sm-2">Date</th>
            <th class="col-sm-2">Client</th>
            <th class="col-sm-3">Projet</th>
            <th class="col-sm-5">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($parameters as $param) {?>
            <?php 
            $style = '';
            in_array($param->rep_id_parameter, $liste_id_parametres) ?
                    $style = "display:none;" :
                    $style = "";
            ?>
            <tr class="center text-center">
                <td><?= $param->date_creation?></td>
                <td><?= $param->nom_client?></td>
                <td><?= $param->nom_application?></td>
                <td style="text-align: left;">
                <div class="col-sm-4"></div>
                <div class="col-sm-7">
                    <button type="button" id="btn_interface_saisie" class="btn btn-primary btn_interface_saisie" title="ouvrir interface de saisie"  
                            data-toggle="modal" data-target="#modal_saisie" 
                            data-id="<?= $param->rep_id_parameter?>">
                        <span class="fa fa-pencil"></span>
                    </button>&nbsp;

                    <button type="button" id="btn_show_param" class="btn btn-info" title="voir paramètre" 
                            data-toggle="modal" data-target="#modal_show_param" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("show_param")?>">
                        <span class="fa fa-eye"></span>
                    </button>&nbsp;

                    <button type="button" id="btn_edit_param" class="btn btn-success" title="editer paramètre" 
                            data-toggle="modal" data-target="#modal_param" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("show_param")?>">
                        <span class="fa fa-highlighter"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-warning btn-edit-reporting" title="editer données" 
                            data-toggle="modal" data-target="#modal_edit_reporting" 
                            data-id="<?= $param->rep_id_parameter?>">
                        <span class="fa fa-edit"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-secondary btn-history" title="voir historique du paramètre" 
                            data-toggle="modal" data-target="#modal_show_history" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("param_history")?>">
                        <span class="fa fa-history"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-danger btn-delete " title="supprimer parametrage" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("delete_param") ?>"
                            style="<?= $style ?>">
                        <span class="fa fa-trash"></span>
                    </button>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



