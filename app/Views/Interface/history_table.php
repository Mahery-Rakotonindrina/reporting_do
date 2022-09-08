<table class="table table-striped tableFixHead" id="Table_history" style="font-size:1.1em">
    <thead>
        <tr class="center text-center">
            <th class="col-sm-1">Date</th>
            <th class="col-sm-1">Client</th>
            <th class="col-sm-1">Code Commande</th>
            <th class="col-sm-1">Projet</th>
            <th class="col-sm-1">Unité de volume</th>
            <th class="col-sm-1">Objectif cadence</th>
            <th class="col-sm-1">Taux d'occupation</th>
            <th class="col-sm-1">DMT</th>
            <th class="col-sm-1">Reliquat initial</th>
            <th class="col-sm-1">Début application</th>
            <th class="col-sm-1">Fin Application</th>
            <th class="col-sm-1">Statut</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($history as $param) {?>
            <tr class="center text-center">
                <td><?= $param->date_creation?></td>
                <td><?= $param->nom_client?></td>
                <td><?= $param->code?></td>
                <td><?= $param->nom_application?></td>
                <td><?= $param->rep_unite?></td>
                <td><?= $param->rep_objectif_cadence?></td>
                <td><?= $param->rep_taux_occupation?></td>
                <td><?= $param->rep_dmt?></td>
                <td><?= $param->rep_reliquat_initial?></td>
                <td><?= $param->rep_date_debut_application?></td>
                <td><?= $param->rep_date_fin_application?></td>
                <td><?= $param->statut == 1 ?
                        '<span class="fa fa-check" style="color:green;font-size:1.8em" title="actif"></span>' : 
                        '<span class="fa fa-xmark" style="color:red;font-size:1.8em" title="inactif"></span>'; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>






