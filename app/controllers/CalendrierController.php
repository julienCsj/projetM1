<?php
class CalendrierController extends BaseController {
	public function getCalendrier()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Le calendrier',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Le calendrier')
               );
        return View::make('calendrier')->with($data);
    }

}