<div>
    <table class="table table-striped tableFixHead table-bordered table-responsive center text-center" id="Table_history" style="font-size:1.1em">
        <thead>
            <tr class="center text-center">
                <th>Date</th>
                <th>Matricule</th>
                <th>Client</th>
                <th>Email</th>
                <th>Code Commande</th>
                <th>Projet</th>
                <th>Unité de volume</th>
                <th>Objectif cadence</th>
                <th>Taux d'occupation</th>
                <th>DMT</th>
                <th>Reliquat initial</th>
                <th>Objectif delai median</th>
                <th>Objectif delai moyen</th>
                <th>Taux de respect du délai</th>
                <th>2ème Taux de respect du délai</th>
                <th>Taux de contrôle</th>
                <th>Taux de conformité</th>
                <th>Début application</th>
                <th>Fin Application</th>
                <th>Graphe</th>
                <th>Statut</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($history as $param) {?>
                <tr class="center text-center">
                    <td style="padding-top:15px; white-space: nowrap;"><?= $param->date_creation?></td>
                    <td><?= $param->rep_matricule_creat?></td>
                    <td><?= $param->nom_client?></td>
                    <td><?= $param->rep_mail_client?></td>
                    <td><?= $param->code?></td>
                    <td><?= $param->nom_application?></td>
                    <td><?= $param->rep_unite?></td>
                    <td><?= $param->rep_objectif_cadence?></td>
                    <td><?= $param->rep_taux_occupation?></td>
                    <td><?= $param->rep_dmt?></td>
                    <td><?= $param->rep_reliquat_initial?></td>
                    <td><?= $param->rep_objectif_delai_median?></td>
                    <td><?= $param->rep_objectif_delai_moyen?></td>
                    <td><?= $param->rep_taux_respect_delai?></td>
                    <td><?= $param->rep_taux_respect_delai_2?></td>
                    <td><?= $param->rep_taux_controle?></td>
                    <td><?= $param->rep_taux_conformite?></td>
                    <td><?= $param->rep_date_debut_application?></td>
                    <td><?= $param->rep_date_fin_application?></td>
                    <td><?= $param->rep_graphe == true ?
                        '<span class="fa fa-check" style="color:green;font-size:1.8em" title="Oui"></span>' : 
                        '<span class="fa fa-xmark" style="color:red;font-size:1.8em" title="Non"></span>'; ?></td>
                    <td><?= $param->statut == 1 ?
                            '<span class="fa fa-check" style="color:green;font-size:1.8em" title="actif"></span>' : 
                            '<span class="fa fa-xmark" style="color:red;font-size:1.8em" title="inactif"></span>'; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>





