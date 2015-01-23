<?php
class EnseignantController extends BaseController {
	public function getEnseignants()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Les enseignants',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Les enseignants')
               );
        return View::make('enseignant')->with($data);
    }

}