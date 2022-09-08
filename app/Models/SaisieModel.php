<?php
namespace App\Models;

use CodeIgniter\Model;

class SaisieModel extends Model
{
    protected $table            = 'reporting_do_saisie';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function insertSaisie($date, $colonne, $valeur, $id_param){
        $retour = $this->verifsaisie($date,$id_param);
        $sql = '';

        if($retour == false){
            $sql = "INSERT INTO ".$this->table." (saisie_date, ".$colonne.", saisie_id_parameter) VALUES ('".$date."',".$valeur.", $id_param)";
        }else{
            $sql = "UPDATE ".$this->table." SET ".$colonne." = ".$valeur." WHERE saisie_date = '".$date."' AND saisie_id_parameter = ".$id_param;
        }
        $query = $this->db->query($sql);
        return $query;
    }

    private function verifsaisie($date, $id_param){
        $sql_if = "SELECT * from ".$this->table." WHERE saisie_date = '".$date."' AND saisie_id_parameter = ".$id_param;       
        $query = $this->db->query($sql_if);

        return $query->getResult();
    }

    public function getsaisibydate($where, $id_param){
        $sql = "SELECT * from ".$this->table." WHERE saisie_date::date ".$where." AND saisie_id_parameter = ".$id_param." ORDER BY saisie_date asc";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    private function verifcolonnevide($colonne,$date){
        $sql = "SELECT * from ".$this->table." WHERE saisie_date =".$date." AND ".$colonne." IS NOT NULL";
        $query = $this->db->query($sql);

        return $query->getResult();
    }

    public function verifiData($date, $param){
        $sql = "SELECT 
                saisie_date::date, 
                saisie_volume_previsionnel, 
                saisie_volume_recu,  
                saisie_volume_bloque, 
                saisie_volume_a_traite,
                saisie_volume_traite,
                saisie_hprod,
                saisie_reliquat, 
                saisie_cadence, 
                saisie_taux_performance_prod, 
                saisie_taux_respect_delai_livraison, 
                saisie_volume_a_controler, 
                saisie_volume_ko,
                saisie_volume_controle,
                saisie_traitement_conforme, 
                saisie_id_parameter
                FROM ".$this->table."
                WHERE saisie_date::date = '".$date."' AND saisie_id_parameter = ".$param;
                
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function UpdateDataAutoCalculate($data){
        $sql = "UPDATE reporting_do_saisie 
                    SET saisie_qualite_prevision            =".$data['saisie_qualite_prevision']." , 
                        saisie_planification_wfm            =".$data['saisie_planification_wfm'].", 
                        saisie_volume_a_traite              = ".$data['saisie_volume_a_traiter'].",
                        saisie_reliquat                     = ".$data['saisie_reliquat'].",
                        saisie_cadence                      = ".$data['saisie_cadence'].",
                        saisie_taux_performance_prod        = ".$data['saisie_taux_performance_prod'].",
                        saisie_taux_respect_delai_livraison = ".$data['saisie_taux_respect_delai_livraison'].",
                        saisie_volume_a_controler           = ".$data['saisie_volume_a_controler'].",
                        saisie_traitement_conforme          = ".$data['saisie_traitement_conforme']."
                    WHERE  saisie_date::date = '".$data['date']."' and saisie_id_parameter =".$data['id_param'];

        $query = $this->db->query($sql);
    }

    public function getListeAvoirSaisie(){
        $sql = "SELECT distinct saisie_id_parameter FROM ".$this->table." ORDER BY saisie_id_parameter asc";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getAllDataSaisie(){
        $sql = " SELECT * FROM ".$this->table." order by saisie_id_parameter, saisie_date";

        $query = $this->query($sql);
        return $query->getResult();
    }

    public function getAllSaisieForVisu($client, $projet){
        $sql = " SELECT rds.*, nom_client, nom_application
                    FROM ".$this->table." rds 
                    LEFT JOIN reporting_do_parameter rdp on rdp.rep_id_parameter = rds.saisie_id_parameter
                    LEFT JOIN gu_client gc on gc.id_client = rdp.rep_id_client
                    LEFT JOIN gu_application ga on ga.id_application = rdp.rep_id_projet
                    WHERE 1 = 1";
        
        if($client != ''){
            $sql .= " AND gc.nom_client ilike '%".$client."%' ";
        }

        if($projet != ''){
            $sql .= " AND ga.nom_application ilike '%".$projet."%' ";
        }

        $sql .= " ORDER BY saisie_date,nom_client"; 

        $query = $this->query($sql);
        return $query->getResult();
    }

}