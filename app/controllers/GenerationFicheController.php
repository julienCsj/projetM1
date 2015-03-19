<?php

class GenerationFicheController extends BaseController {

    public function getFiche($idEnseignant = -1) {
        $lesEnseignants = Enseignant::getEnseignantsWithPageData();

        //exit(var_dump($lesEnseignants));

        $data = array(
            'breadcrumb' => array("Scolarel", "Fiche"),
            'lesEnseignants' => $lesEnseignants,
            'idEnseignant' => $idEnseignant,
        );

        //exit(var_dump($data));
        if($idEnseignant != -1) {
            $data['enseignant'] = Enseignant::where('login', '=', $idEnseignant)->get();
            $data['voeux'] = Voeux::getVoeux($idEnseignant);
            $data['heuresexternes'] = HeureExterne::where('enseignantID', '=', $idEnseignant)->get();
        }

        return View::make('fiche')->with($data);
    }
}