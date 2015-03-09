<?php
class HeuresExternesController extends BaseController {
    public function getHeuresExternes()
    {
        setlocale(LC_ALL, 'fr_FR');

        $semaine_date_deb ="2014-09-01";
        $semaine_date_fin = "2015-08-31";
        $date1 = explode('-', $semaine_date_deb);
        $semaine_date_deb = mktime(0,0,0,$date1[1],$date1[2],$date1[0]);
        $date2 = explode('-', $semaine_date_fin);
        $semaine_date_fin = mktime(0,0,0,$date2[1],$date2[2],$date2[0]);
        $semaine = 7 * 24 * 60 * 60 ;
        $i=$semaine_date_deb;

        $lesSemaines = array();

        while($i<$semaine_date_fin){
            $s=date('W',$i);
            $infos_semaine = array('numero_semaine' => $s, 'jour' => date('d', $i), 'mois' => date('F', $i));
            $lesSemaines[date('m', $i)][] = $infos_semaine;
            $i=$i+$semaine;
        }

        //exit(var_dump($lesSemaines));
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'Heures exterieures'),
            'lesSemaines' => $lesSemaines,
        );

        return View::make('heures_externes')->with($data);
    }

}




