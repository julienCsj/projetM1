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
    public function getHeuresFormation($idFormation = -1) {
        $formation = Formation::getFormationSimple($idFormation);
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 
                                array("label"=>'Liste des UE', "link" => URL::route('etudiant')),
                                $formation->long_title
                    ),
            "formation" => $formation
        );
        $data["service"] = CalculerChargeService::genererEmploiDuTempsFormation($idFormation);

        return View::make('etudiant_detail')->with($data);
    }
}
