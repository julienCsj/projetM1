<?php
class ServiceController extends BaseController {
    public function getService()
    {
        $userId = Session::get("user")->LOGIN;
        $config = Configuration::find(1);
        $statut = Enseignant::getOneEnseignantAndStatus($userId);

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'le service'),
            'service' => CalculerChargeService::calculerServiceEnseignantParSemaine($userId),
            'service_global' => CalculerChargeService::calculerServiceEnseignantGlobal($userId, $config, $statut->SERVICE_STATUTAIRE),
            'VALEUR_CM_HSERVICE' => floatval($config["valeurCMEnHService"]),
            'VALEUR_TD_HSERVICE' => floatval($config["valeurTDEnHService"]),
            'VALEUR_TP_HSERVICE' => floatval($config["valeurTPEnHService"]),
            'VALEUR_CM_HSERVICE_HCC' => floatval($config["valeurCMEnHServiceHCC"]),
            'VALEUR_TD_HSERVICE_HCC' => floatval($config["valeurTDEnHServiceHCC"]),
            'VALEUR_TP_HSERVICE_HCC' => floatval($config["valeurTPEnHServiceHCC"]),
            'palier' => $statut->SERVICE_STATUTAIRE
        );
        return View::make('service')->with($data);
    }

}