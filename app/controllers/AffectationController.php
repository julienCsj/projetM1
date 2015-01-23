<?php
class AffectationController extends BaseController {
	public function getAffectation()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'affectation',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'affectation')
               );
        return View::make('affectation')->with($data);
    }

}