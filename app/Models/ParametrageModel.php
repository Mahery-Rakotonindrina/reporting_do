<?php
namespace App\Models;

use CodeIgniter\Model;

Class ParametrageModel extends Model
{
    protected $table            = 'reporting_do_parameter';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function getClientReporting(){
        $sql = 'SELECT distinct id_client, nom_client FROM
                    (SELECT id_application, nom_application, code,lib_bu,gu_client.id_client,nom_client
                        FROM gu_application
                    inner join gu_client on gu_client.id_client = gu_application.id_client
                    inner join business_unit on business_unit.id_bu = gu_application.id_bu
                    where business_unit.id_bu in (3,4))data_client
                    order by nom_client asc';
            
         $query = $this->db->query($sql);  
         return $query->getResult();
    }

    public function getProjectByClient($id_client, $code){
        $sql = 'SELECT id_application, nom_application, code,lib_bu,gu_client.id_client,nom_client
                    FROM gu_application
                inner join gu_client on gu_client.id_client = gu_application.id_client
                inner join business_unit on business_unit.id_bu = gu_application.id_bu
                where business_unit.id_bu in (3,4) and gu_client.id_client ='.$id_client;
        
        if($code != null){
            $sql .= "and code ='".$code."'";
        }

        $query = $this->db->query($sql);  
        return $query->getResult();
    }

    public function getCodeByClient($id_client){
        $sql = 'SELECT id_application,code,gu_client.id_client,nom_client
                    FROM gu_application
                inner join gu_client on gu_client.id_client = gu_application.id_client
                inner join business_unit on business_unit.id_bu = gu_application.id_bu
                where business_unit.id_bu in (3,4) and gu_client.id_client ='.$id_client;
        
        $query = $this->db->query($sql);  
        return $query->getResult();
    }

    public function addNewParam($data){
        
        $this->db->table('reporting_do_parameter')->insert($data);
        $req_id = $this->db->insertID();
        
        return $req_id;
        
    }

    public function getAllParametreModel($debut =null, $fin=null){
        $sql = 'SELECT rep_id_parameter, nom_client, nom_application, code, rep_date_create::date as date_creation, rep_is_current, rep_statut
                    FROM reporting_do_parameter
                inner join gu_client gc on gc.id_client = rep_id_client
                inner join gu_application ga on ga.id_application = rep_id_projet';

        if($debut != null && $fin != null){
            $sql .= " WHERE (rep_date_create::date between '".$debut."' AND '".$fin."')";
        }
        
        $sql .= " AND rep_is_current =1 and rep_statut in (1,2) ORDER BY date_creation, nom_client , nom_application ASC";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getParamById($id){
        $sql = "SELECT rep_id_parameter, 
                        rep_id_client, nom_client,
                        rep_id_projet,nom_application,
                        rep_code, rep_date_debut_application::date,
                        rep_date_fin_application::date,
                        rep_matricule_creat, 
                        rep_date_create, 
                        rep_mail_client, 
                        rep_unite, 
                        rep_objectif_cadence, 
                        rep_taux_occupation, 
                        rep_dmt, 
                        rep_reliquat_initial, 
                        rep_objectif_delai_median, 
                        rep_objectif_delai_moyen, 
                        rep_taux_respect_delai, 
                        rep_taux_respect_delai_2, 
                        rep_taux_controle, 
                        rep_taux_conformite, 
                        CASE WHEN rep_graphe = false THEN 'Non' ELSE 'Oui' END as rep_graphe,
                        rep_id_parent,
                        rep_is_current,
                        rep_statut
                    FROM public.reporting_do_parameter
                inner join gu_application ga on ga.id_application = rep_id_projet
                inner join gu_client gc on gc.id_client = rep_id_client
                where rep_id_parameter = ".$id;
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function setCurrentReporting($old_id, $id){
        $sql= "UPDATE public.reporting_do_parameter
                SET rep_statut=2, rep_is_current=0, rep_date_fin_application = now()
                WHERE (rep_id_parent = ".$old_id." or rep_id_parameter = ".$old_id.") and rep_id_parameter <> ".$id." and rep_date_fin_application is null";
        $query = $this->db->query($sql);
    }

    public function setCurrentOnDelete($id){
        $sql = "UPDATE public.reporting_do_parameter
                SET rep_is_current = 0, rep_date_fin_application = now()
                WHERE rep_id_parameter = ".$id;
        $query = $this->db->query($sql);
    }

    public function getHistoryById($id, $id_parent){
        $sql = "SELECT rep_id_parameter, 
                        nom_client, 
                        rep_mail_client,  
                        rep_matricule_creat, 
                        nom_application, 
                        rep_unite,
                        rep_objectif_cadence,
                        rep_taux_occupation,
                        rep_dmt,
                        code, 
                        rep_reliquat_initial,
                        rep_date_create::date as date_creation, 
                        rep_is_current, 
                        rps.id as statut, 
                        rep_date_debut_application,
                        rep_date_fin_application,
                        rep_objectif_delai_median, 
                        rep_objectif_delai_moyen, 
                        rep_taux_respect_delai, 
                        rep_taux_respect_delai_2,
                        rep_taux_controle,
                        rep_taux_conformite, 
                        rep_graphe
                    FROM reporting_do_parameter
                inner join gu_client gc on gc.id_client = rep_id_client
                inner join gu_application ga on ga.id_application = rep_id_projet
                inner join reporting_do_statuts rps  on rps.id = reporting_do_parameter.rep_statut 
                WHERE ";
                ($id_parent != -1) ?
                    $sql .= "rep_id_parameter in (".$id.",".$id_parent.") OR rep_id_parent = ".$id_parent :
                    $sql .= "rep_id_parameter = ".$id;
                $sql .= " ORDER BY rep_date_create ASC";
                
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getAllVisuParamter($date_debut, $date_fin , $client, $projet){
        $sql="SELECT rep_id_parameter, 
                    gc.nom_client,
                    ga.nom_application,
                    rep_code, 
                    rep_date_debut_application::date as rep_date_debut_application, 
                    rep_date_fin_application::date as rep_date_fin_application, 
                    rep_matricule_creat, 
                    rep_date_create::date as date_creation, 
                    rep_mail_client, 
                    rep_unite, 
                    rep_objectif_cadence, 
                    rep_taux_occupation, 
                    rep_dmt, 
                    rep_reliquat_initial, 
                    rep_objectif_delai_median, 
                    rep_objectif_delai_moyen, 
                    rep_taux_respect_delai, 
                    rep_taux_respect_delai_2, 
                    rep_taux_controle, 
                    rep_taux_conformite, 
                    CASE WHEN rep_graphe = false THEN 'Non' ELSE 'Oui' END as rep_graphe, 
                    rep_id_parent, 
                    rds.rep_statut, 
                    rep_is_current
                FROM public.reporting_do_parameter rdp
                inner join gu_client gc on gc.id_client = rdp.rep_id_client
                inner join gu_application ga on ga.id_application = rdp.rep_id_projet
                inner join reporting_do_statuts rds on rds.id = rdp.rep_statut
                
                WHERE rep_is_current = 1";

                if($client != ''){
                    $sql .= " AND gc.nom_client ilike '%".$client."%' ";
                }

                if($projet != ''){
                    $sql .= " AND ga.nom_application ilike '%".$projet."%' ";
                }
        $query= $this->db->query($sql);
        return $query->getResult();

    }

    public function getAllParametrageForApi(){
        $sql = " SELECT * FROM ".$this->table." order by rep_id_parameter";

        $query = $this->query($sql);
        return $query->getResult();
    }
}