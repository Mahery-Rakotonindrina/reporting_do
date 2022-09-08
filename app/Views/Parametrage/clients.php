<select id="client_select" name="client" class="form-control form-parameter field-profil">
    <option value="" disabled selected>Sélectionner un client</option>
    <?php foreach($clients as $client) {?>
    <option value="<?=$client->id_client?>"> <?=$client->nom_client?> </option>
<?php } ?>
</select>
