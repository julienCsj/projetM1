<?php
class HeuresExternesController extends BaseController {
	public function getHeuresExternes()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Les heures externe',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Les heures externes')
               );
        return View::make('heures_externes')->with($data);
    }

}