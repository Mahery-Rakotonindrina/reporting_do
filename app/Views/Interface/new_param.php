<div class="modal fade" id="modal_param" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <form id="form-param_ajout" action="<?= route_to("add_param")?>" data-modif_action="<?= route_to("edit_param")?>" method="POST">
      <div class="modal-header">
        <div class="row">
            <h5 class="modal-title col-sm-11" id="exampleModalLongTitle">Nouveaux Paramétrages</h5>
            <label class="switch" style="display: none;">
                <input type="checkbox" name="rep_status" class="check_is_active">
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
                                <div class="col-sm-6" id="select_client">
                                    <select name="client" class="form-control form-parameter field-profil" required>
                                        <option value="" disabled selected>Sélectionner un client</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"> <input type="checkbox" name="mail_check" id="mail_check">&nbsp;&nbsp;&nbsp;E-mail :</label>
                                <div class="col-sm-7">
                                    <input id="mail" type="mail" name="mail" class="form-control form-parameter field-profil" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Code Commande
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-6" id="select_code_commande">
                                    <select id="code_commande" name="code_commande" class="form-control form-parameter field-profil" disabled required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
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
                                <div class="col-sm-6">
                                    <input type="text" id="unite_volume" name="unite_volume" maxlength="50" class="form-control form-parameter field-profil" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Objectif cadence
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input type="text" id="obj_cadence" name="obj_cadence" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux d'occupation
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-6">
                                    <input id="taux_occupation" type="text" name="taux_occ" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">DMT
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input id="dmt" type="text" name="dmt" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Reliquat Initial
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-6">
                                    <input id="reliquat" type="text" name="rel_init" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
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
                                <div class="col-sm-6">
                                    <input type="text" id="obj_del_median" name="obj_del_median" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4"><input type="checkbox" name="obj_moy_check" id="obj_moy_check">&nbsp;&nbsp;&nbsp;Obj délai moyen :</label>
                                <div class="col-sm-7">
                                    <input type="text" id="obj_del_moyen" name="obj_del_moyen" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux de respect du délai 
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-6">
                                    <input type="text" id="t_resp_del" name="t_resp_del" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">2ème Taux de respect du délai 
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input type="text" id="t_resp_del2" name="t_resp_del2" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux de contrôle
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-6">
                                    <input type="text" id="t_ctrl" name="t_ctrl" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">   
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label col-sm-4">Taux de conformité
                                    <span class="text-danger obligatoire">(*)</span>  :</label>
                                <div class="col-sm-7">
                                    <input type="text" id="t_cnft" name="t_cnft" maxlength="50" class="form-control form-parameter field-profil form-number" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="row form-group" id="form-group-profil-ajout">
                                <label class="control-label "> <input type="checkbox" id="graphe_show" name="graphe">&nbsp;&nbsp;&nbsp;Graphe</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row" style="padding:0px 10px 0px 10px;">
                    <div class="col-sm-5" style="text-align:left;">
                        <p style="color:red;"> (*) Champ obligatoire</p>
                    </div>
                    <div class="col-sm-7">
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
