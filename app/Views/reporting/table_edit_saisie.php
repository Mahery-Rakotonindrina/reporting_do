<div>
    <input type="hidden" id='route_insert_saisi' value="<?= route_to('insert_update_saisie') ?>" data-mod='edit-rep'>
    <table class="table table-striped tableFixHead table-bordered table-responsive center text-center " id="table_saisi-edit" style="font-size:1em">
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
            <tr class="centexr text-center">
                <th rowspan="2">Semaine</th>
                <th rowspan="2">Date</th>
                <th style="background-color:rgb(242, 242, 217);">Volume prévisionnel</th>
                <th style="background-color:rgb(242, 242, 217);">Volume reçu</th>
                <th rowspan="2">Qualité de prévision </br> (80 & 120 %)</th>
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
                <th >Volume à contrôler</th>
                <th colspan="3">Objectif de conformité: <?= number_format($params[0]->rep_taux_conformite,2,',','')?>%</th>
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
                <th style="background-color:rgb(242, 242, 217);">Volume contrôlés</th>
                <th style="background-color:rgb(242, 242, 217);">Volume KO</th>
                <th >% Traitement conforme</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($resultats as $resultat) { 
            $date = $resultat->saisie_date;
            $date = new DateTime($date);
            $date_week = $date->format('W');
            $date_d = $date->format('d/m/Y');
            ?>
                <tr class="center text-center">
                    <td style="padding-top:15px"><?= 'S '.$date_week ?></td>
                    <td style="padding-top:15px; white-space: nowrap;" data-date_saisi='<?= $date_d ?>' id="date_saisi"><?= $date_d ?></td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_previsionnel.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_previsionnel ?>">
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_recu.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_recu?>">
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_qualite_prevision.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_qualite_prevision != null ? number_format($resultat->saisie_qualite_prevision,0,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_planification_wfm.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_planification_wfm != null ? number_format($resultat->saisie_planification_wfm,0,',','') : ''?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_planification_rp.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_planification_rp?>">
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_volume_a_traite.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_a_traite != null ? number_format($resultat->saisie_volume_a_traite,0,',','') : ''?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_bloque.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_bloque ?>">
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_traite.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_traite ?>">
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_reliquat.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_reliquat != null ? number_format($resultat->saisie_reliquat,2,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_hprod.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_hprod ?>">
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_cadence.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_cadence != null ? number_format($resultat->saisie_cadence,2,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_taux_performance_prod.<?= $date_d ?>"  
                               value="<?= $resultat->saisie_taux_performance_prod != null ? number_format($resultat->saisie_taux_performance_prod,0,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_taux_respect_delai_livraison.<?= $date_d ?>"  
                               value="<?= $resultat->saisie_taux_respect_delai_livraison != null ? number_format($resultat->saisie_taux_respect_delai_livraison,0,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_volume_a_controler.<?= $date_d ?>"  
                               value="<?= $resultat->saisie_volume_a_controler != null ? number_format($resultat->saisie_volume_a_controler,0,',','') : '' ?>" 
                               readonly>
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_controle.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_controle ?>">
                    </td>
                    <td>
                        <input type="number" 
                               class="form-control form-input" 
                               id="saisie_volume_ko.<?= $date_d ?>" 
                               value="<?= $resultat->saisie_volume_ko ?>">
                    </td>
                    <td>
                        <input type="text" 
                               class="form-control form-input" 
                               id="saisie_traitement_conforme.<?= $date_d ?>"  
                               value="<?= $resultat->saisie_traitement_conforme != null ? number_format($resultat->saisie_traitement_conforme,2,',','') : ''?>" 
                               readonly>
                    </td>
                </tr>
            <?php }?>

        </tbody>
    </table>
</div>