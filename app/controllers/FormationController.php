<?php
class FormationController extends BaseController {
	public function getFormations()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Les formations',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Les formations')
               );
        return View::make('formation')->with($data);
    }

}