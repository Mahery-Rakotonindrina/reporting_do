<div style="overflow:auto">
    <input type="hidden" id='route_insert_saisi' value="<?= route_to('insert_update_saisie') ?>" data-mod='saisie-rep'>    
    <table class="table table-striped tableFixHead table-bordered table-responsive" id="table_saisi" style="font-size:1.1em">
        <thead>
            <tr class="center text-center">
                <th class="col-sm-1">Semaine</th>
                <th class="col-sm-1">Date</th>
                <th class="col-sm-1" >Volume prévisionnel</th>
                <th class="col-sm-1" >Volume reçu</th>
                <th class="col-sm-1" >Planification RP</th>
                <th class="col-sm-1" >Volume bloqué</th>
                <th class="col-sm-1" >Volume traité</th>
                <th class="col-sm-1" >HPROD</th>
                <th class="col-sm-1" >Volume controlé</th>
                <th class="col-sm-1" >Volume KO</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($res as $resultat) { 
                $date_saisie =  \DateTime::createFromFormat('Y-m-d', $resultat['date_saisi']);
                $date_saisie = $date_saisie->format('d/m/Y');
                ?>
                <tr class="center text-center">
                    <td style="padding-top:15px"><?= 'S '.$resultat['week_saisi'] ?></td>
                    <td style="padding-top:15px; white-space: nowrap;" data-date_saisi='<?= $resultat['date_saisi'] ?>' id="date_saisi"><?= $date_saisie ?></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_previsionnel.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_recu.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_planification_rp.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_bloque.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_traite.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_hprod.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_controle.<?= $resultat['date_saisi'] ?>""></td>
                    <td><input type="number" class="form-control form-input" id="saisie_volume_ko.<?= $resultat['date_saisi'] ?>""></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>