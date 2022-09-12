<select id="code_commande" name="code_commande" class="form-control form-parameter field-profil" disabled required>
    <option value="" disabled selected>Sélectionner un client</option>
    <?php foreach($codes as $code){?>
        <option value="<?= $code->code?>"> <?= $code->code ?></option>
    <?php }?>
</select>