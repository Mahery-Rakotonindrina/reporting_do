<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

function date_veroux() {
    $h_dt = new DateTime(date('Y-m'.'-01'));
    $lim_dt = $h_dt;
    if(date('d') < 5){
        $h_dt->modify("-1 day");
        $h_dt2 = new DateTime(date($h_dt->format('Y-m').'-01'));
        $lim_dt = $h_dt2;
    }
    return $lim_dt;
}

function date_sql($code_date, $date_1, $date_2) {
    $date1 = date_transform($date_1);
    $date2 = date_transform($date_2);
    
    if($date2 != '' && $date1 > $date2){
        $temp = $date1;
        $date1 = $date2;
        $date2 = $temp;
    }
    
    switch ($code_date) {
        case "d":
            return " between '$date1' and '$date1' ";
        case "dd":
            return " between '$date1' and '$date2' ";
        case "j":
            return " between '".date("Y-m-d")."' and '".date("Y-m-d")."' ";
        case "1j":
            $ajrd = new DateTime(date('Y-m-d'));
            $ajrd->modify("-1 day");
            return " between '".$ajrd->format("Y-m-d")."' and '".$ajrd->format("Y-m-d")."' ";
        case "s":
            return la_semaine();
        case "1s":
            return last_semaine();
        case "m":
            return " between '".date("Y-m-01")."' and '".date("Y-m-t")."' ";
        case "1m":
            return last_mois();
        default:
            return NULL;
    }
}

function getdatefiltre($code, $date_1, $date_2)
{
    $date1 = date_transform($date_1);
    $date2 = date_transform($date_2);
    if($date2 != '' && $date1 > $date2){
        $temp = $date1;
        $date1 = $date2;
        $date2 = $temp;
    }
    switch($code){
        case 'd' :
            $res = array();
            $date1 = new DateTime($date1);

            array_push($res, ["date_saisi" => $date1->format('Y-m-d'), "week_saisi" => $date1->format('W')]);
            return $res;
        case 'dd':
            $deb =  \DateTime::createFromFormat('Y-m-d', $date1);
            $fin =  \DateTime::createFromFormat('Y-m-d', $date2);
            $fin = $fin->modify('+1 day');

            $res = getdatebetween($deb, $fin);
           return $res;
        case 'j' :
            $res = array();
            $j = new DateTime(date('Y-m-d'));

            array_push($res, ["date_saisi" => $j->format('Y-m-d'), "week_saisi" => $j->format('W')]);
            return $res;
        case '1j':
            $res = array();
            $j = new DateTime(date('Y-m-d'));
            $j = $j->modify('-1 day');

            array_push($res, ["date_saisi" => $j->format('Y-m-d'), "week_saisi" => $j->format('W')]);
            return $res;
        case 's' :
            $deb = dernier_lundi();
            $fin = prochain_dimanche();
            $fin = $fin->modify('+1 day');

            $res = getdatebetween($deb, $fin);
            return $res;
        case '1s':
            $deb = dernier_lundi();
            $deb->modify("-7 day");
            $fin = dernier_lundi();

            $res = getdatebetween($deb, $fin);
            return $res;
        case 'm' :
            $deb = new DateTime(date('Y-m-01'));
            $fin = new DateTime(date('Y-m-t'));
            $fin->modify('+1 day');

            $res = getdatebetween($deb, $fin);
            return $res;
        case '1m' :
            $date = new DateTime(date('Y-m-01'));
            $date->modify("-1 day");
            $deb = $date->format('Y-m-01');
            $deb = \DateTime::createFromFormat('Y-m-d', $deb);
            $fin = $date;
            
            $res = getdatebetween($deb, $fin);
            return $res;
        default:
            return NULL;
    }
}

function getdatebetween($date1, $date2)
{
    $res = array();

    $period = new \DatePeriod(
        $date1,
         new \DateInterval('P1D'),
         $date2
    );
    foreach($period as $peri){
        array_push($res, ["date_saisi" => $peri->format('Y-m-d'), "week_saisi" => $peri->format('W')]);
    }
    return $res;
}

function separe_date($btwn_dt, $num = 1){
    preg_match("#between '(.+)'.*and.*'(.+)'#",$btwn_dt, $matches);
    if(count($matches)>1){
        return $matches[$num];
    }
    return '';
}

function la_semaine() {
    $debut = dernier_lundi();
    $fin = prochain_dimanche();
    return " between '".$debut->format("Y-m-d")."' and '".$fin->format("Y-m-d")."' ";
}

function last_semaine() {
    $debut = dernier_lundi();
    $debut->modify("-7 day");
    $fin = dernier_lundi();
    $fin->modify("-1 day");
    return " between '".$debut->format("Y-m-d")."' and '".$fin->format("Y-m-d")."' ";
}

function last_mois() {
    $fin = new DateTime(date('Y-m-01'));
    $fin->modify("-1 day");
    $dt2 = $fin->format("Y-m-d");
    $dt1 = $fin->format('Y-m-').'01';
    return " between '".$dt1."' and '".$dt2."' ";
}

function prochain_dimanche(){
	$ajrd = new DateTime(date('Y-m-d'));
	while($ajrd->format('N') != 7){
		$ajrd->modify("+1 day");
	}
	return $ajrd;
}

function dernier_lundi(){
	$ajrd = new DateTime(date('Y-m-d'));
	while($ajrd->format('N') != 1){
		$ajrd->modify("-1 day");
	}
	return $ajrd;
}

function date_transform($date_fr){
    preg_match('#(\d{2})-(\d{2})-(\d{4})#',$date_fr, $matches);
    if(count($matches)>3){
        return $matches[3].'-'.$matches[2].'-'.$matches[1];
    }
    return "";
}

function date_fr($date_us){
    preg_match('#(\d{4})-(\d{2})-(\d{2})#',$date_us, $matches);
    if(count($matches)>3){
        return $matches[3].'-'.$matches[2].'-'.$matches[1];
    }
    return "";
}

function date_fr1($date_us){
    preg_match('#(\d{4})-(\d{2})-(\d{2})#',$date_us, $matches);
    if(count($matches)>3){
        return $matches[3].'/'.$matches[2].'/'.$matches[1];
    }
    return "";
}

function date_str($dt, $hr) {
    $tab_time = explode('.', $hr);
    return trim(date_fr1($dt). ' '. $tab_time[0]);
}

function date_str_1($dt){
    $tab = explode(' ', $dt);
    return date_str($tab[0], $tab[1]);
}

function seconde_to_duree($sec) {
    $heures = intval($sec / 3600);
    $rest = $sec - (3600 * $heures);
    $minutes = intval($rest / 60);
    $secondes = $rest - (60 * $minutes);
    $heures = $heures < 10 ? '0'.$heures : $heures;
    $minutes = $minutes < 10 ? '0'.$minutes : $minutes;
    $secondes = $secondes < 10 ? '0'.$secondes : $secondes;
    return $heures.':'.$minutes.':'.$secondes;
}

function duree_activite($param) {
    $reponse = str_replace('days', 'jrs', $param);
    $reponse = str_replace('day', 'jr', $reponse);
    $reponse_tab = explode('.', $reponse);
    $reponse = $reponse_tab[0];
    $reponse_tab = explode(':', $reponse);
    $reponse = $reponse_tab[0].'hr '.$reponse_tab[1].'mn';
    return $reponse;
}

function duree_activite_nb_heures($param) {
    $temp_str = str_replace(' days ', '/', $param);
    $temp_str = str_replace(' day ', '/', $temp_str);
    $temp_str = str_replace(':', '/', $temp_str);
    $temp_tab = explode('/', $temp_str);
    switch (count($temp_tab)) {
        case 4:
            return ($temp_tab[0]*24)+($temp_tab[1])+($temp_tab[2]/60);
        case 3:
            return ($temp_tab[0])+($temp_tab[1]/60);
        default:
            return 0;
    }
}

function is_weekend($dt){
    if(!preg_match("#^\d{4}-\d{2}-\d{2}$#", $dt)){
        return NULL;
    }
    $la_date = new DateTime(date($dt));
    $jr = $la_date->format('N');
    if($jr == 6 || $jr == 7){
        return TRUE;
    }
    return FALSE;
}