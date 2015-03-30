<?php
class ServiceController extends BaseController {
    public function getService()
    {   $userId = Session::get("user")->LOGIN;
        //setlocale(LC_ALL, 'fr_FR');
        //exit(var_dump(CalculerChargeService::calculerServiceEnseignantParSemaine(Session::get("user")->id)));
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'le service'),
            'service' => CalculerChargeService::calculerServiceEnseignantParSemaine($userId),
            'service_global' => CalculerChargeService::calculerServiceEnseignantGlobal($userId),
            'VALEUR_CM_HSERVICE' => 1.7,
            'VALEUR_TD_HSERVICE' => 1.2,
        );
        return View::make('service')->with($data);
    }

}