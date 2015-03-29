<?php
class ServiceController extends BaseController {
    public function getService()
    {
        //setlocale(LC_ALL, 'fr_FR');

        //exit(var_dump(CalculerChargeService::calculerServiceEnseignantParSemaine(Session::get("user")->id)));
        $data = array(
            'notifications' => array(
                array(
                    'type' => 'success',
                    'titre' => 'Le service',
                    'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter',
                )),
            'breadcrumb' => array('#ApplicationJaneDoe', 'le service'),
            'service' => CalculerChargeService::calculerServiceEnseignantParSemaine(Session::get("user")->id),
        );
        return View::make('service')->with($data);
    }

}