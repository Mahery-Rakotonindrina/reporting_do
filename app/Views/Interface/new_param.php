<div class="modal fade" id="modal_param" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <form id="form-param_ajout" action="<?= route_to("add_param")?>" data-modif_action="<?= route_to("edit_param")?>" method="POST">
      <div class="modal-header">
        <div class="row">
            <h5 class="modal-title col-sm-11" id="exampleModalLongTitle">Nouveaux Paramétrages</h5>
            <label class="switch" style="display: none;">
                <input type="checkbox" name="rep_status" id="check_is_active">
                <span class="slider round"></span>
            </label>
        </div>
      </div>
      <div class="modal-body" style="padding-right:30px;">
                <div class="form-horizontal">
                    <input type="hidden" class="form-parameter" id="id_parameter" name="rep_id_parameter">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Client
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7" id="select_client">
                                    <select name="client" class="form-control form-parameter field-profil" required>
                                        <option value="" disabled selected>Sélectionner un client</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"> <input type="checkbox" name="mail_check" id="mail_check">&nbsp;&nbsp;&nbsp;E-mail :</label>
                                <div class="col-sm-7">
                                    <input id="mail" type="mail" name="mail" class="form-control form-parameter field-profil" disabled/>
                                    <div id='invalid_email' style='color: red; display:none'><span class='fa fa-sharp fa-solid fa-triangle-exclamation' style='color: red;font-size:20px'></span>&nbsp;&nbsp;&nbsp;Mettre un bon format pour le e-mail</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Code Commande
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7" id="select_code_commande">
                                    <select id="code_commande" name="code_commande" class="form-control form-parameter field-profil" disabled required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Projet
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <select name="projet" id="projet" class="form-control form-parameter field-profil" disabled required>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Unité de volume
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input type="text" id="unite_volume" name="unite_volume" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Objectif cadence
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="number" step=0.5 id="obj_cadence" name="obj_cadence" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                        <div class="input-group-addon">
                                        /h
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux d'occupation
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input id="taux_occupation" type="number" step=0.01 name="taux_occ" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                        <div class="input-group-addon">
                                        %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">DMT
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input id="dmt" type="text" name="dmt" maxlength="50" class="form-control form-parameter field-profil" placeholder="">
                                        <div class="input-group-addon">
                                        s
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Reliquat Initial
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input id="reliquat" type="number" name="rel_init" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Date d'application
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input id="date_app" id="date_app" name="date_app" type="text" maxlength="50" class="form-control form-parameter field-profil" value="<?= date('d/m/Y')?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"><input type="checkbox" name="obj_med_check" id="obj_med_check">&nbsp;&nbsp;&nbsp;Obj délai médian :</label>
                                <div class="col-sm-7">
                                    <input type="number" step=0.01 id="obj_del_median" name="obj_del_median" maxlength="50" class="form-control form-parameter field-profil" placeholder="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"><input type="checkbox" name="obj_moy_check" id="obj_moy_check">&nbsp;&nbsp;&nbsp;Obj délai moyen :</label>
                                <div class="col-sm-7">
                                    <input type="number" step=0.01 id="obj_del_moyen" name="obj_del_moyen" maxlength="50" class="form-control form-parameter field-profil" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Objectif de délai 
                                <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="form-row row" style="margin-left:0px ;">
                                        <div class="input-group col-sm-5">
                                            <input type="number" step=0.5 id="obj_delai_1" name="obj_delai_1" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                            <div class="input-group-addon">
                                                %
                                            </div>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select class="col-sm-3 form-control" id="obj_del_inite_1_1" name="obj_del_inite_1_1">
                                            <option value="J" selected>J</option>
                                            <option value="H">H</option>
                                        </select>
                                        <select class="col-sm-3 form-control" id="obj_del_inite_1_2" name="obj_del_inite_1_2">
                                            <?php for($i=0; $i<=24; $i++){?>
                                                <option value="<?= $i ?>" <?= ($i == 0) ? 'selected' : ''?>><?= '+'.$i?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"><!--<input type="checkbox" name="obj_del_2" id="obj_del_2">&nbsp;&nbsp;&nbsp;-->2ème Objectif de délai 
                                <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="form-row row" style="margin-left:0px ;">
                                        <div class="input-group col-sm-5">
                                            <input type="number" step=0.5 id="obj_delai_2" name="obj_delai_2" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                            <div class="input-group-addon">
                                                %
                                            </div>
                                            <!-- <input class="form-control" type="text"  placeholder="City"> -->
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select class="col-sm-3 form-control" id="obj_del_inite_2_1" name="obj_del_inite_2_1">
                                            <option value="J" selected>J</option>
                                            <option value="H">H</option>
                                        </select>
                                        <select class="col-sm-3 form-control" id="obj_del_inite_2_2" name="obj_del_inite_2_2">
                                            <?php for($i=0; $i<=24; $i++){?>
                                                <option value="<?= $i ?>" <?= ($i == 1) ? 'selected' : ''?>><?= '+'.$i?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux de respect du délai 
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                    <input type="number" step=0.01 id="t_resp_del" name="t_resp_del" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                        <div class="input-group-addon">
                                        %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"><input type="checkbox" name="taux2_check" id="taux2_check">&nbsp;&nbsp;&nbsp;2ème Taux de respect du délai :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="number" step=0.01 id="t_resp_del2" name="t_resp_del2" maxlength="50" class="form-control form-parameter field-profil" placeholder="" disabled>
                                        <div class="input-group-addon">
                                        %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4" title="Taux d'échantionnage">Taux de contrôle
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="number" step=0.01 id="t_ctrl" name="t_ctrl" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                        <div class="input-group-addon">
                                        %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">   
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4" title="Taux qualité">Taux de conformité
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="number" step=0.01 id="t_cnft" name="t_cnft" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                        <div class="input-group-addon">
                                        %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row" style="padding:0px 10px 0px 10px;">
                    <div class="col-sm-2" style="text-align:left;">
                        <p style="color:red;"> (*) Champ obligatoire</p>
                    </div>
                    <div class="col-sm-2">
                        <p style="color:red;">Les colonnes taux sont exprimées en %</p>
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success btn-sm" id="btn-enregistrer-param">
                            <span class="fa fa-save"></span>&nbsp;&nbsp;Enregistrer
                        </button>
                        <button type="button" class="btn btn-danger btn-sm fermer-modal" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;&nbsp;Fermer</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
</div>
