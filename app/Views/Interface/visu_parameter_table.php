<div style="overflow:auto">
<table class="table table-striped tableFixHead table-bordered table-responsive" id="Table_data_visu">
    <thead>
        <tr class="center text-center">
            <th class="col-sm-1">Date</th>
            <th class="col-sm-1">Client</th>
            <?php if (in_array('code', $ck)) {?>
                <th class="col-sm-1">Code Commande</th>
            <?php }?>
                <th class="col-sm-1">Projet</th>
            <?php if (in_array('date_deb_app', $ck)) {?>
                <th class="col-sm-1">Date debut application</th>
            <?php }?>
            <?php if (in_array('date_fin_app', $ck)) {?>
                <th class="col-sm-1">Date fin application</th>
            <?php }?>
            <?php if (in_array('matricule', $ck)) {?>
                <th class="col-sm-1">Matricule</th>
            <?php }?>
            <?php if (in_array('mail', $ck)) {?>
                <th class="col-sm-1">Mail Client</th>
            <?php }?>
            <?php if (in_array('unite', $ck)) {?>
                <th class="col-sm-1">Unite de Volume</th>
            <?php }?>
            <?php if (in_array('obj_cadence', $ck)) {?>
                <th class="col-sm-1">Objectif Cadence</th>
            <?php }?>
            <?php if (in_array('t_occup', $ck)) {?>
                <th class="col-sm-1">Taux d'occupation</th>
            <?php }?>
            <?php if (in_array('dmt', $ck)) {?>
                <th class="col-sm-1">DMT</th>
            <?php }?>
            <?php if (in_array('rel_init', $ck)) {?>
                <th class="col-sm-1">Reliquat initial</th>
            <?php }?>
            <?php if (in_array('obj_del_med', $ck)) {?>
                <th class="col-sm-1">Objectif délai median</th>
            <?php }?>
            <?php if (in_array('obj_del_moy', $ck)) {?>
                <th class="col-sm-1">Objectif délai moyen</th>
            <?php }?>
            <?php if (in_array('t_resp_del', $ck)) {?>
                <th class="col-sm-1">Taux respect délai</th>
            <?php }?>
            <?php if (in_array('t_resp_del_2', $ck)) {?>
                <th class="col-sm-1">2ème Taux respect délai</th>
            <?php }?>
            <?php if (in_array('t_controle', $ck)) {?>
                <th class="col-sm-1">Taux de contrôle</th>
            <?php }?>
            <?php if (in_array('t_conf', $ck)) {?>
                <th class="col-sm-1">Taux de conformité</th>
            <?php }?>
            <?php if (in_array('graphe', $ck)) {?>
                <th class="col-sm-1">Graphe</th>
            <?php }?>
            <?php if (in_array('statut', $ck)) {?>
                <th class="col-sm-1">Statut</th>
            <?php }?>
        </tr>
    </thead>

    <tbody>
        <?php foreach($visu as $param) {?>
            <tr class="center text-center">
                <td><?= $param->date_creation?></td>
                <td><?= $param->nom_client?></td>
                <?php if (in_array('code', $ck)) {?>
                    <td><?= $param->rep_code?></td>
                <?php }?>
                <td><?= $param->nom_application?></td>
                <?php if (in_array('date_fin_app', $ck)) {?>
                    <td><?= $param->rep_date_debut_application?></td>
                <?php }?>
                <?php if (in_array('date_fin_app', $ck)) {?>
                    <td><?= $param->rep_date_fin_application?></td>
                <?php }?>
                <?php if (in_array('matricule', $ck)) {?>
                    <td><?= $param->rep_matricule_creat?></td>
                <?php }?>
                <?php if (in_array('mail', $ck)) {?>
                    <td><?= $param->rep_mail_client?></td>
                <?php }?>
                <?php if (in_array('unite', $ck)) {?>
                    <td><?= $param->rep_unite?></td>
                <?php }?>
                <?php if (in_array('obj_cadence', $ck)) {?>
                    <td><?= $param->rep_objectif_cadence?></td>
                <?php }?>
                <?php if (in_array('t_occup', $ck)) {?>
                    <td><?= $param->rep_taux_occupation?></td>
                <?php }?>
                <?php if (in_array('dmt', $ck)) {?>
                    <td><?= $param->rep_dmt?></td>
                <?php }?>
                <?php if (in_array('rel_init', $ck)) {?>
                    <td><?= $param->rep_reliquat_initial?></td>
                <?php }?>
                <?php if (in_array('obj_del_med', $ck)) {?>
                    <td><?= $param->rep_objectif_delai_median?></td>
                <?php }?>
                <?php if (in_array('obj_del_moy', $ck)) {?>
                    <td><?= $param->rep_objectif_delai_moyen?></td>
                <?php }?>
                <?php if (in_array('t_resp_del', $ck)) {?>
                    <td><?= $param->rep_taux_respect_delai?></td>
                <?php }?>
                <?php if (in_array('t_resp_del_2', $ck)) {?>
                    <td><?= $param->rep_taux_respect_delai_2?></td>
                <?php }?>
                <?php if (in_array('t_controle', $ck)) {?>
                    <td><?= $param->rep_taux_controle?></td>
                <?php }?>
                <?php if (in_array('t_conf', $ck)) {?>
                    <td><?= $param->rep_taux_conformite?></td>
                <?php }?>
                <?php if (in_array('graphe', $ck)) {?>
                    <td><?= $param->rep_graphe?></td>
                <?php }?>
                <?php if (in_array('statut', $ck)) {?>
                    <td><?= $param->rep_statut?></td>
                <?php }?>

            </tr>
        <?php } ?>
    </tbody>
</table>
</div>





