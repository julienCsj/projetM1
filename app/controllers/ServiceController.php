<?php
class ServiceController extends BaseController {
	public function getService()
    {


        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Le service',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'le service')
               );
        return View::make('service')->with($data);
    }

}