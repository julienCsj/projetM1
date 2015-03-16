<?php

class EtudiantController extends BaseController {


    public function getListeFormation() {
        $lesFormations = Formation::getFormationUeModule();

        $data = array(
            'notifications' => array(),
            'lesFormations' => $lesFormations,
            'breadcrumb' => array('Scolarel', 'Liste des UE')
        );

        return View::make('etudiant')->with($data);
    }
    public function getHeuresFormation($idFormation = -1, $idUe = -1) {
        $formation = Formation::getFormationSimple($idFormation);

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 
                                array("label"=>'Liste des UE', "link" => URL::route('etudiant')),
                                $formation->long_title
                    ),
            "formation" => $formation
        );
        $formation = Formation::getFormationSimple($idFormation);
        $modules = Module::getModuleByUE($idUe);
        $data['UElist'] = array();
        foreach ($modules as $k => $module) {
            $mod = Module::getModuleWithData($module->id);
            $data['UElist'][$k]['module'] = $mod;
            $data['UElist'][$k]['lesCours'] = Cours::where('moduleID', '=', $module->id)->get();

            $heureCM = 0;
            $heureTD = 0;
            $heureTP = 0;
            foreach($data['UElist'][$k]['lesCours'] as $c) {
                switch($c->type) {
                    case "cm" :
                        $heureCM += $c->duree;
                        break;
                    case "td" :
                        $heureTD += $c->duree;
                        break;
                    case "tp" :
                        $heureTP += $c->duree;
                        break;
                }
            }
            // Calcul des totaux pour les CM, TD, TP
            $data['UElist'][$k]['totalCM'] = floor($heureCM / 60)."h".$heureCM % 60 ."0";
            $data['UElist'][$k]['totalTD'] = floor($heureTD / 60)."h".$heureTD % 60 ."0";
            $data['UElist'][$k]['totalTP'] = floor($heureTP / 60)."h".$heureTP % 60 ."0";
        }

        return View::make('etudiant_detail')->with($data);
    }
}
