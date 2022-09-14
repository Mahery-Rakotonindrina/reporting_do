<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParametrageModel;

Class Parametrage extends BaseController
{
    protected $reporting;
    protected $session;

    public function __construct()
    {
        parent::__construct();
        $this->reporting = new ParametrageModel();

        $retour = array(
            'message' => 'NOK',
            'statut' => 400
        );

    }

    public function GetCLient()
    {
        $clients = $this->reporting->getClientReporting();
        $this->data['clients'] = $clients;
        return view('Parametrage/clients.php',$this->data);
    }

    Public function GetProjet()
    {
        $id_client =  $this->request->getpost('client'); 
        $code =  $this->request->getpost('code'); 
        
        $projet =  $this->reporting->getProjectByClient($id_client, $code);

        echo json_encode($projet);
    }

    public function getCode()
    {
        $id_client =  $this->request->getpost('client'); 
        
        $code = $this->reporting->getCodeByClient($id_client);
        echo json_encode($code);
    }

    public function newParam()
    {
        $date_create = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_app'));
        $date_deb_app = $date_create->format('Y-m-d');
 
        $graphe = ($this->request->getPost('graphe') != null)? true : false;
        $req =$this->request->getpost('rep_status');

        $donnees = array(
            'rep_id_client' =>  $this->request->getpost('client'),
            'rep_id_projet' => $this->request->getpost('projet'),
            'rep_code' => $this->request->getpost('code_commande'),
            'rep_date_debut_application' => $date_deb_app,
            'rep_matricule_creat' => intval($this->session->get('matricule')),
            'rep_mail_client' =>($this->request->getpost('mail')) !== null ? $this->request->getpost('mail') : '',
            'rep_unite' => $this->request->getpost('unite_volume'),
            'rep_objectif_cadence' => $this->request->getpost('obj_cadence'),
            'rep_taux_occupation' => $this->request->getpost('taux_occ'),
            'rep_dmt' => $this->request->getpost('dmt'),
            'rep_reliquat_initial' => $this->request->getpost('rel_init'),
            'rep_objectif_delai_median' =>($this->request->getpost('obj_del_median')) !== null ? $this->request->getpost('obj_del_median') : null,
            'rep_objectif_delai_moyen' =>($this->request->getpost('obj_del_moyen')) !== null ? $this->request->getpost('obj_del_moyen') : null,
            'rep_taux_respect_delai' => $this->request->getpost('t_resp_del'),
            'rep_taux_respect_delai_2' => $this->request->getpost('t_resp_del2'),
            'rep_taux_controle' => $this->request->getpost('t_ctrl'),
            'rep_taux_conformite' => $this->request->getpost('t_cnft'),
            'rep_graphe' => $graphe
        );

        try{
            $param = $this->reporting->addNewParam($donnees);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        if($param != ''){
            $retour = array(
                'message' => 'OK',
                'statut' => 200
            );
        }

        echo json_encode($retour);
    }

    public function showParam()
    {
        $id = intval($this->request->getpost('id'));
        $param = $this->reporting->getParamById($id);
        echo json_encode($param[0]);
    }

    public function editParam()
    {
        // var_dump($this->request->getPost());die;
        $date_create = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_app'));
        $date_deb_app = $date_create->format('Y-m-d');
        $id = $this->request->getpost('rep_id_parameter');

        $old_param = $this->reporting->getParamById($id);
        $old_param[0]->rep_id_parent == -1 ?
            $id_parent = $id :
            $id_parent = $old_param[0]->rep_id_parent;
 
        $graphe = ($this->request->getPost('graphe') != null)? true : false;
        $donnees = array(
            'rep_id_client' =>  $this->request->getpost('client'),
            'rep_id_projet' => $this->request->getpost('projet'),
            'rep_code' => $this->request->getpost('code_commande'),
            'rep_date_debut_application' => $date_deb_app,
            'rep_matricule_creat' => intval($this->session->get('matricule')),
            'rep_mail_client' =>(($this->request->getpost('mail')) !== null) ? $this->request->getpost('mail') : '',
            'rep_unite' => $this->request->getpost('unite_volume'),
            'rep_objectif_cadence' => $this->request->getpost('obj_cadence'),
            'rep_taux_occupation' => $this->request->getpost('taux_occ'),
            'rep_dmt' => $this->request->getpost('dmt'),
            'rep_reliquat_initial' => $this->request->getpost('rel_init'),
            'rep_objectif_delai_median' =>($this->request->getpost('obj_del_median')) !== null ? $this->request->getpost('obj_del_median') : null,
            'rep_objectif_delai_moyen' =>($this->request->getpost('obj_del_moyen')) !== null ? $this->request->getpost('obj_del_moyen') : null,
            'rep_taux_respect_delai' => $this->request->getpost('t_resp_del'),
            'rep_taux_respect_delai_2' => $this->request->getpost('t_resp_del2'),
            'rep_taux_controle' => $this->request->getpost('t_ctrl'),
            'rep_taux_conformite' => $this->request->getpost('t_cnft'),
            'rep_graphe' => $graphe,
            'rep_id_parent' => $id_parent,
            'rep_statut' => $this->request->getpost('rep_status') == 'on' ? 1:2
        );

        try{
            $param = $this->reporting->addNewParam($donnees);

            $new_param =  $this->reporting->getParamById($param);

            $old_param_id = $new_param[0]->rep_id_parent;
            $set_current = $this->reporting->setCurrentReporting($old_param_id, $param);

        }catch(\Exception $e){
            return $e->getMessage();
        }

        if($param != ''){
            $retour = array(
                'message' => 'OK',
                'statut' => 200
            );
        }

        echo json_encode($retour);
    }

    public function deleteParam()
    {
        $id = $this->request->getpost("id");
        $old_param = $this->reporting->getParamById($id);

        $donnees = array(
            'rep_id_client' =>  $old_param[0]->rep_id_client,
            'rep_id_projet' => $old_param[0]->rep_id_projet,
            'rep_code' => $old_param[0]->rep_code,
            'rep_date_debut_application' => $old_param[0]->rep_date_debut_application,
            'rep_matricule_creat' => $old_param[0]->rep_matricule_creat,
            'rep_mail_client' => $old_param[0]->rep_mail_client,
            'rep_unite' => $old_param[0]->rep_unite,
            'rep_objectif_cadence' => $old_param[0]->rep_objectif_cadence,
            'rep_taux_occupation' => $old_param[0]->rep_taux_occupation,
            'rep_dmt' => $old_param[0]->rep_dmt,
            'rep_reliquat_initial' => $old_param[0]->rep_reliquat_initial,
            'rep_objectif_delai_median' => $old_param[0]->rep_objectif_delai_median,
            'rep_objectif_delai_moyen' => $old_param[0]->rep_objectif_delai_moyen,
            'rep_taux_respect_delai' => $old_param[0]->rep_taux_respect_delai,
            'rep_taux_respect_delai_2' => $old_param[0]->rep_taux_respect_delai_2,
            'rep_taux_controle' => $old_param[0]->rep_taux_controle,
            'rep_taux_conformite' => $old_param[0]->rep_taux_conformite,
            'rep_graphe' => $old_param[0]->rep_graphe == 'Oui' ? true : false,
            'rep_id_parent' => $old_param[0]->rep_id_parent,
            'rep_statut' => 3,
            'rep_is_current' => 1
        );

        try{
            $param = $this->reporting->addNewParam($donnees);
            $this->reporting->setCurrentOnDelete($id);

        }catch( \Exception $e){
            return $e->getMessage();
        }

        if($param != ''){
            $retour = array(
                'message' => 'OK',
                'statut' => 200
            );
        }
        echo json_encode($retour);
    }

    public function getParamHistory()
    {
        $id = $this->request->getpost('id');
        $param = $this->reporting->getParamById($id);
        $id_parent = $param[0]->rep_id_parent;

        $param_history = $this->reporting->getHistoryById($id, $id_parent);
        $this->data['history'] = $param_history;

        return view('Interface/history_table.php', $this->data);
    }
}