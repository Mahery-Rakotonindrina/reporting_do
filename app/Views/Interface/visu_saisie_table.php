<div>
    <table class="table table-striped tableFixHead table-bordered table-responsive center text-center" id="table_visu_saisie" style="font-size:1em">
        <thead>
            <tr>
                <th colspan="3"></th>
                <th colspan="5">KPI Prévision</th>
                <th colspan="7">KPI Performance interne</th>
                <th colspan="5">KPI Engagement Client</th>
            </tr>
            <tr class="center text-center">
                <th>Date</th>
                <th>Client</th>
                <th>Projet</th>
                <th style="background-color:rgb(242, 242, 217);">Volume prévisionnel</th>
                <th style="background-color:rgb(242, 242, 217);">Volume reçu</th>
                <th>Qualité de prévidion </br> (80 & 120%)</th>
                <th>Planification WFM</th>
                <th style="background-color:rgb(242, 242, 217);">Planification RP</th>
                <th >Volume A traiter</th>
                <th style="background-color:rgb(242, 242, 217);">Volume bloqué</th>
                <th style="background-color:rgb(242, 242, 217);">Volume traité</th>
                <th >Reliquat</th>
                <th style="background-color:rgb(242, 242, 217);">HPROD</th>
                <th >Cadence</th>
                <th>Taux de performance de production</th>
                <th >Taux de respect <br>de Délai de livraison</th>
                <th >Volume à controler</th>
                <th style="background-color:rgb(242, 242, 217);">Volume controlés</th>
                <th style="background-color:rgb(242, 242, 217);">Volume KO</th>
                <th >% Taitement conformes</th>
            </tr>
            
        </thead>
        <tbody>
            <?php foreach($saisies as $saisie) {
                $date = $saisie->saisie_date;
                $date = new DateTime($date);
                $date_d = $date->format('Y-m-d');?>

                <tr>
                    <td style="padding-top:15px; white-space: nowrap;"><?= $date_d ?></td>
                    <td style="padding-top:15px; white-space: nowrap;"><?= $saisie->nom_client?></td>
                    <td style="padding-top:15px; white-space: nowrap;"><?= $saisie->nom_application?></td>
                    <td><?= $saisie->saisie_volume_previsionnel?></td>
                    <td><?= $saisie->saisie_volume_recu?></td>
                    <td><?= $saisie->saisie_qualite_prevision?></td>
                    <td><?= $saisie->saisie_planification_wfm?></td>
                    <td><?= $saisie->saisie_planification_rp?></td>
                    <td><?= $saisie->saisie_volume_a_traite?></td>
                    <td><?= $saisie->saisie_volume_bloque?></td>
                    <td><?= $saisie->saisie_volume_traite?></td>
                    <td><?= $saisie->saisie_reliquat?></td>
                    <td><?= $saisie->saisie_hprod?></td>
                    <td><?= $saisie->saisie_cadence?></td>
                    <td><?= $saisie->saisie_taux_performance_prod?></td>
                    <td><?= $saisie->saisie_taux_respect_delai_livraison?></td>
                    <td><?= $saisie->saisie_volume_a_controler?></td>
                    <td><?= $saisie->saisie_volume_controle?></td>
                    <td><?= $saisie->saisie_volume_ko?></td>
                    <td><?= $saisie->saisie_traitement_conforme?></td>
                    
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>