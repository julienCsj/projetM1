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
            $config = Configuration::find(1);
            $data['enseignant'] = Enseignant::where('login', '=', $idEnseignant)->get();
            $data["statut"] = Enseignant::getOneEnseignantAndStatus($idEnseignant);
            $data['voeux'] = Voeux::getVoeux($idEnseignant);
            $data['heuresexternes'] = HeureExterne::where('enseignantID', '=', $idEnseignant)->get();
            $data['service_global'] = CalculerChargeService::calculerServiceEnseignantGlobal($idEnseignant, $config, $data["statut"]->SERVICE_STATUTAIRE);
            $data['service'] = CalculerChargeService::calculerServiceEnseignantParSemaine($idEnseignant);
            $data['VALEUR_CM_HSERVICE'] = floatval($config["valeurCMEnHService"]);
            $data['VALEUR_TD_HSERVICE'] = floatval($config["valeurTDEnHService"]);
            $data['VALEUR_TP_HSERVICE'] = floatval($config["valeurTPEnHService"]);
            $data['VALEUR_CM_HSERVICE_HCC'] = floatval($config["valeurCMEnHServiceHCC"]);
            $data['VALEUR_TD_HSERVICE_HCC'] = floatval($config["valeurTDEnHServiceHCC"]);
            $data['VALEUR_TP_HSERVICE_HCC'] = floatval($config["valeurTPEnHServiceHCC"]);
        }

        return View::make('fiche')->with($data);
    }
}