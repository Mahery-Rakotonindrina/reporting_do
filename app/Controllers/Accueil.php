<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ParametrageModel;
use App\Models\SaisieModel;
use CodeIgniter\HTTP\Response;

class Accueil extends BaseController
{
    protected $reporting;
    protected $saisie;

    public function __construct(){
        parent::__construct();

        $this->reporting = new ParametrageModel();
        $this->saisie    = new SaisieModel();
        $this->data['contenu'] = 'Interface/accueil';
        $this->data['require_js'] = array('acc.js','parametrage.js','saisie.js');

    }

    public function index()
    {
        return $this->ChargerPage();
    }

    public function GetListeReporting()
    {
        $date_debut = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_debut'));
        $debut = $date_debut->format('Y-m-d');
        $date_fin = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_fin'));
        $fin = $date_fin->format('Y-m-d');

        $param = $this->reporting->getAllParametreModel($debut,$fin);
        $param_deja_saisie = $this->saisie->getListeAvoirSaisie();

        $liste_id_param = array();
        foreach($param_deja_saisie as $saisi){
            array_push($liste_id_param, $saisi->saisie_id_parameter);
        }
        
        $this->data['liste_id_parametres'] =$liste_id_param;
        $this->data['parameters'] = $param;

        return view('Interface/liste_reporting', $this->data);
    }

    public function VisuParameter()
    {
        $debut = null;
        $fin = null;
        if ($this->request->getpost('date_deb') != null && $this->request->getpost('date_fin') != null){
            $date_debut = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_deb'));
            $debut = $date_debut->format('Y-m-d');
            $date_fin = \DateTime::createFromFormat('d/m/Y', $this->request->getpost('date_fin'));
            $fin = $date_fin->format('Y-m-d');
        } 
    
        $client= $this->request->getpost('client');
        $projet= $this->request->getpost('projet');
        $check = $this->request->getpost('check');
        $ck = explode(",", $check);
        $this->data['ck'] = $ck;


        $visu = $this->reporting->getAllVisuParamter($debut, $fin, $client, $projet);
        $this->data['visu'] = $visu;

        return view('Interface/visu_parameter_table', $this->data);
    }

}