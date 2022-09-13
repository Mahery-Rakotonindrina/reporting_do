<?php

namespace App\Controllers;

use App\Models\ParametrageModel;
use App\Models\SaisieModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class API extends BaseController
{
    protected $parametrage;
    protected $saisie;

    public function __construct()
    {
        parent::__construct();
        $this->parametrage = new ParametrageModel;
        $this->saisie = new SaisieModel;
    }

    use ResponseTrait;
    public function getAllSaisie()
    {
        $retour = '';
        $data = getallheaders()['Authorization'];
        
        if(trim($data) == '43908e4829b22dd58c9bca6f02a6782a'){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $data_saisie = $this->saisie->getAllDataSaisie();
                
                count($data_saisie) != 0 ?
                    $retour = $data_saisie:
                    $retour = array(
                        'status' => 204,
                        'message' => 'Warning!! No content, data is empty :) '
                    );
            }else{
                $retour = array(
                    'status' => 400,
                    'message' => 'Error!! Please verify your request method and make sure that it is a POST ;)'
                );
            }
        }else{
            $retour = array(
                'status' => 403 ,
                'message' => 'sorry, you don\'t have access to this request, please check your token'
            );
        }
        

        return $this->respond($retour);
    }

    public function getAllParametrage()
    {
        $retour = '';
        $data = getallheaders()['Authorization'];

        if (trim($data) == '43908e4829b22dd58c9bca6f02a6782a') {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $data_parametrage = $this->parametrage->getAllParametrageForApi();
                
                count($data_parametrage) != 0 ?
                    $retour = $data_parametrage:
                    $retour = array(
                        'status' => 204,
                        'message' => 'Warning!! No content, data is empty :) '
                    );
            }else{
                $retour = array(
                    'status' => 400,
                    'message' => 'Error!! Please verify your request method and make sure that it is a POST ;)'
                );
            }
        }else{
            $retour = array(
                'status' => 403 ,
                'message' => 'sorry, you don\'t have access to this request, please check your token'
            );
        }

        return $this->respond($retour);
    }
}