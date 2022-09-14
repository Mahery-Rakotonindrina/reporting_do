<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParametrageModel;
use App\Models\SaisieModel;
use CodeIgniter\HTTP\Response;

class Saisie extends BaseController
{
    protected $reporting;
    protected $saisie;

    public function __construct()
    {
        parent::__construct();
        $this->saisie = new SaisieModel();
        $this->reporting = new ParametrageModel();
        helper('daty');

    }

    public function getInterface()
    {
        $chx_date = $this->request->getpost('chx_date');
        $this->request->getpost('date_1') != '' ?
                $date_debut = $this->request->getpost('date_1'):
                $date_debut = '';
        $this->request->getpost('date_2') != '' ?
            $date_fin= $this->request->getpost('date_2') :
            $date_fin = '';

        $id_param = $this->request->getpost('id_param');
        $param = $this->reporting->getParamById($id_param);

        $res = getdatefiltre($chx_date, $date_debut, $date_fin);
        
        $this->data['res'] = $res;
        $this->data['params'] = $param;
        return view('/reporting/table_saisie', $this->data);
    }

    public function InsertOrUpdateSaisie()
    {
        $date =  $this->request->getpost('date');
        $colonne = $this->request->getpost('col');
        $valeur = $this->request->getpost('value');
        ($valeur != '') ? $valeur = $valeur : $valeur = 'NULL';
        
        $id_parametrage = $this->request->getpost('id_param');
        

        $insert = $this->saisie->insertSaisie($date, $colonne, $valeur, $id_parametrage);
        if($insert){
            $date_J_moin1 = \DateTime::createFromFormat('Y-m-d', $date);
            $date_J_moin1->modify('-1 day');
            $date_J_moin1 = $date_J_moin1->format('Y-m-d');
            $this->calculerAuto($date, $id_parametrage, $date_J_moin1);
        }
    }

    public function calculerAuto($date, $param, $J_moin1)
    {
        $data = $this->saisie->verifiData($date, $param);
        $data_moin1 = $this->saisie->verifiData($J_moin1, $param);
        $data_param =  $this->reporting->getParamById($param); 

        $qualite_prevision = '';
        $planification_wfm = '';
        $volume_a_traiter  = '';
        $reliquat_J_moin1  = '';
        $reliquat_J        = '';
        $cadence_J         = '';
        $taux_perf         = '';
        $taux_resp_del     = '';
        $volume_a_controler= '';
        $taux_traitmnt_conf= '';

        $res = [];

        /***************Calcule de la qualité de prévision*****************/
        (isset($data[0]) 
            && $data[0]->saisie_volume_previsionnel != NULL 
                &&  $data[0]->saisie_volume_recu != NULL) ?
            $qualite_prevision = ($data[0]->saisie_volume_recu / $data[0]->saisie_volume_previsionnel)*100 :
            $qualite_prevision = '';

        /***************Calcule de la planification WFM*****************/
        (isset($data[0])
            && $data[0]->saisie_volume_previsionnel != NULL) ?
                $planification_wfm =  ($data[0]->saisie_volume_previsionnel / $data_param[0]->rep_objectif_cadence ):
                $planification_wfm = '';

        /***************Calcule du volume a traiter *****************/
        isset($data_moin1[0]) ?
                $reliquat_J_moin1 = $data_moin1[0]->saisie_reliquat :
                $reliquat_J_moin1 = $data_param[0]->rep_reliquat_initial;

        /****************Volume bloque*****************/
        (isset($data[0]->saisie_volume_bloque) && $data[0]->saisie_volume_bloque!= null) ? 
            $volume_bloquer = $data[0]->saisie_volume_bloque : 
            $volume_bloquer = 0;

        /****************Calcul du volume a traiter*********************/
        (isset($data[0])
            &&  $data[0]->saisie_volume_recu != NULL) ?
                    $volume_a_traiter = ($data[0]->saisie_volume_recu + $reliquat_J_moin1) - $volume_bloquer :
                    $volume_a_traiter = '';

        /****************Calcule du reliquat J***********************/
        (isset($data[0])
            && $volume_a_traiter != NULL 
                && $data[0]->saisie_volume_traite != NULL) ? 
                        $reliquat_J = $volume_a_traiter - $data[0]->saisie_volume_traite - $volume_bloquer:
                        $reliquat_J = '';
        /****************Calcule du Cadence************************/
        (isset($data[0])
            && $data[0]->saisie_volume_traite != NULL 
                && $data[0]->saisie_hprod != NULL) ?
                $cadence_J = $data[0]->saisie_volume_traite / $data[0]->saisie_hprod:
                $cadence_J = '';

        /****************Calcule du taux de performance******************/
        (isset($data[0])
            && $data[0]->saisie_cadence != NULL) ?
                $taux_perf = ($data[0]->saisie_cadence / $data_param[0]->rep_objectif_cadence)*100:
                $taux_perf = '';

        /****************Calcule du taux de respect du delai de livraison******************/
        (isset($data[0])
        && $volume_a_traiter != NULL 
            && $data[0]->saisie_volume_traite != NULL) ? 
                    $taux_resp_del = ($data[0]->saisie_volume_traite / ($volume_a_traiter - $volume_bloquer))*100:
                    $taux_resp_del = '';

        /****************Calcule du Volume a controler******************/
        (isset($data[0])
            && $data[0]->saisie_volume_traite != NULL ) ?
                $volume_a_controler = $data[0]->saisie_volume_traite / $data_param[0]->rep_taux_controle:
                $volume_a_controler = '';
        
        /****************Calcule du taux de traitement conforme******************/
        (isset($data[0])
            && $data[0]->saisie_volume_ko != NULL
                && $data[0]->saisie_volume_controle != NULL) ?
                    $taux_traitmnt_conf = number_format(100 - (($data[0]->saisie_volume_ko / $data[0]->saisie_volume_controle)*100),2,'.','') :
                    $taux_traitmnt_conf = '';

        $res['date'] = $date;
        $res['id_param'] = $param;
        $res['saisie_qualite_prevision'] = $qualite_prevision != '' ? number_format($qualite_prevision,2,'.','') : 'NULL';
        $res['saisie_planification_wfm'] = $planification_wfm != '' ? number_format($planification_wfm,2,'.','') : 'NULL';
        $res['saisie_volume_a_traiter']  = $volume_a_traiter  != '' ? number_format($volume_a_traiter ,2,'.','') : 'NULL';
        $res['saisie_reliquat']          = $reliquat_J        != '' ? number_format($reliquat_J,2,'.','')        : 'NULL';
        $res['saisie_cadence']           = $cadence_J         != '' ? number_format($cadence_J,2,'.','') : 'NULL';

        $res['saisie_taux_performance_prod']         = $taux_perf           != '' ? number_format($taux_perf,2,'.','') : 'NULL';
        $res['saisie_taux_respect_delai_livraison']  = $taux_resp_del       != '' ? number_format($taux_resp_del,2,'.','') : 'NULL';
        $res['saisie_volume_a_controler']            = $volume_a_controler  != '' ? number_format($volume_a_controler,2,'.','') : 'NULL';
        $res['saisie_traitement_conforme']           = $taux_traitmnt_conf  != '' ? number_format($taux_traitmnt_conf,2,'.','') : 'NULL';
        
        $resultat = $this->saisie->UpdateDataAutoCalculate($res);
    }

    public function showSaisie()
    {
        $chx_date = $this->request->getpost('chx_date');

        $this->request->getpost('date_1') != '' ?
            $date_debut = $this->request->getpost('date_1'):
            $date_debut = '';
        $this->request->getpost('date_2') != '' ?
            $date_fin= $this->request->getpost('date_2') :
            $date_fin = ''
            ;
        
        $id_param = $this->request->getpost('id_param');
        $param = $this->reporting->getParamById($id_param);
        $sql_where = date_sql($chx_date, $date_debut, $date_fin);
        $resultat = $this->saisie->getsaisibydate($sql_where, $id_param);

        $this->data['params'] = $param;
        $this->data['resultats'] = $resultat;
        return view('/reporting/table_edit_saisie', $this->data);
    }

    public function getAllSaisie()
    {
        $client = $this->request->getpost('client');
        $projet = $this->request->getpost('projet');
        $saisie = $this->saisie->getAllSaisieForVisu($client, $projet);
        $this->data['saisies'] = $saisie;
        return view('/Interface/visu_saisie_table', $this->data);

    }

    public function UpdateDataJplus1()
    {
        for($i = 0; $i<= 30; $i++) {
            $j = $i+1;

            $id_param = $this->request->getPost('param');
            $date_test = $this->request->getPost('date_J');
            $date_J =  \DateTime::createFromFormat('Y-m-d', $date_test);
            $date_J->modify('+'.$i.'day');
            $date_J = $date_J->format('Y-m-d');

            $date_J_plus1 = \DateTime::createFromFormat('Y-m-d', $date_test);
            $date_J_plus1->modify('+'.$j.'day');
            $date_J_plus1 = $date_J_plus1->format('Y-m-d');

            $data_J1 = $this->saisie->verifiData($date_J_plus1, $id_param); 
            if(isset($data_J1[0])){
                $this->calculerAuto($date_J_plus1, $id_param, $date_J);
            }
        }
    }
}
