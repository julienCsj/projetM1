<?php
class VoeuxController extends BaseController {
	public function getVoeux()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Les voeux',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Les voeux')
               );
        return View::make('voeux')->with($data);
    }

}