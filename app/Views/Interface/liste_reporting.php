<table class="table table-striped tableFixHead" id="Table_data">
    <thead>
        <tr class="center text-center">
            <th class="col-sm-2">Date de création</th>
            <th class="col-sm-2">Client</th>
            <th class="col-sm-3">Projet</th>
            <th class="col-sm-5">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($parameters as $param) {
            $style = '';
            in_array($param->rep_id_parameter, $liste_id_parametres) ?
                    $style = "display:none;" :
                    $style = "";

            $date_creation =  \DateTime::createFromFormat('Y-m-d', $param->date_creation);
            $date_creation = $date_creation->format('d/m/Y');

            ?>
            <tr class="center text-center">
                <td><?= $date_creation ?></td>
                <td><?= $param->nom_client?></td>
                <td><?= $param->nom_application?></td>
                <td style="text-align: left;">
                <div class="col-sm-4"></div>
                <div class="col-sm-7">
                    <button type="button" id="btn_interface_saisie" class="btn btn-primary btn_interface_saisie" title="Saisir données"  
                            data-toggle="modal" data-target="#modal_saisie" 
                            data-id="<?= $param->rep_id_parameter?>">
                        <span class="fa fa-pencil"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-warning btn-edit-reporting" title="Editer données" 
                            data-toggle="modal" data-target="#modal_edit_reporting" 
                            data-id="<?= $param->rep_id_parameter?>">
                        <span class="fa fa-edit"></span>
                    </button>&nbsp;

                    <button type="button" id="btn_show_param" class="btn btn-info" title="Voir paramètre" 
                            data-toggle="modal" data-target="#modal_show_param" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("show_param")?>">
                        <span class="fa fa-eye"></span>
                    </button>&nbsp;

                    <button type="button" id="btn_edit_param" class="btn btn-success" title="Editer paramètre" 
                            data-toggle="modal" data-target="#modal_param" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("show_param")?>">
                        <span class="fa fa-highlighter"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-secondary btn-history" title="Voir historique du paramètre" 
                            data-toggle="modal" data-target="#modal_show_history" 
                            data-id="<?= $param->rep_id_parameter?>"
                            data-route="<?= route_to("param_history")?>">
                        <span class="fa fa-history"></span>
                    </button>&nbsp;

                    <button type="button" class="btn btn-danger btn-delete " title="Supprimer parametrage" 
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



