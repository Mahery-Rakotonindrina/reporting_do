<div style="overflow:auto">
    <input type="hidden" id='route_insert_saisi' value="<?= route_to('insert_update_saisie') ?>" data-mod='saisie-rep'>
    <table class="table table-striped tableFixHead table-bordered table-responsive" id="table_saisi" style="font-size:1em">
    <thead>
            <tr>
                <th colspan="2" rowspan="2"></th>
                <th colspan="17"><?= $params[0]->nom_client?></th>
            </tr>
            <tr>
                <th colspan="5">KPI Prévision</th>
                <th colspan="7">KPI Performance interne</th>
                <th colspan="5">KPI Engagement Client</th>
            </tr>
            <tr class="center text-center">
                <th rowspan="2">Semaine</th>
                <th rowspan="2">Date</th>
                <th style="background-color:rgb(242, 242, 217);">Volume prévisionnel</th>
                <th style="background-color:rgb(242, 242, 217);">Volume reçu</th>
                <th rowspan="2">Qualité de prévidion </br> (80 & 120%)</th>
                <th rowspan="2">Planification WFM</th>
                <th style="background-color:rgb(242, 242, 217);" rowspan="2">Planification RP</th>
                <th >Volume A traiter</th>
                <th style="background-color:rgb(242, 242, 217);">Volume bloqué</th>
                <th style="background-color:rgb(242, 242, 217);">Volume traité</th>
                <th >Reliquat</th>
                <th style="background-color:rgb(242, 242, 217);" rowspan="2">HPROD</th>
                <th >Cadence</th>
                <th rowspan="2">Taux de performance de production</th>
                <th >Taux de respect <br>de Délai de livraison</th>
                <th >Volume à controler</th>
                <th colspan="3">Objectif de conformité: <?= $params[0]->rep_taux_conformite ?>%</th>
            </tr>
            <tr>
                <th><?= $params[0]->rep_unite?></th>
                <th><?= $params[0]->rep_unite?></th>
                <th><?= $params[0]->rep_unite?></th>
                <th><?= $params[0]->rep_unite?></th>
                <th><?= $params[0]->rep_unite?></th>
                <th style="background-color: rgb(217, 217, 217);"><?= $params[0]->rep_reliquat_initial?></th>
                <th><?= $params[0]->rep_objectif_cadence?></th>
                <th><?= $params[0]->rep_taux_respect_delai?>% à J</th>
                <th><?= $params[0]->rep_taux_controle?></th>
                <th style="background-color:rgb(242, 242, 217);">Volume controlés</th>
                <th style="background-color:rgb(242, 242, 217);">Volume KO</th>
                <th >% Taitement conformes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($res as $resultat) { ?>
                <tr class="center text-center" id="<?=$resultat['date_saisi']?>">
                    <td style="padding-top:15px"><?= 'S '.$resultat['week_saisi'] ?></td>
                    <td style="padding-top:15px; white-space: nowrap;" data-date_saisi='<?= $resultat['date_saisi'] ?>' id="date_saisi"><?= $resultat['date_saisi'] ?></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_previsionnel.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_recu.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_qualite_prevision.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_planification_wfm.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_planification_rp.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_a_traite.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_bloque.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_traite.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_reliquat.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_hprod.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_cadence.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_taux_performance_prod.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_taux_respect_delai_livraison.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_a_controler.<?= $resultat['date_saisi'] ?>" readonly></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_controle.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_ko.<?= $resultat['date_saisi'] ?>"></td>
                    <td><input type="number" class="form-control form-input" id="saisie_traitement_conforme.<?= $resultat['date_saisi'] ?>" readonly></td>
                </tr>
            <?php }?>

        </tbody>
    </table>
</div>