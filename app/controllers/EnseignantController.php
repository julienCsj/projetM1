<?php
class EnseignantController extends BaseController {
	public function getEnseignants()
    {
      $typeStatus = TypeStatusEnseignant::get();
      $users = User::getEnseignant();
      $data = array(
         'notifications' => array(),
         'breadcrumb' => array('#ApplicationJaneDoe', 'Les enseignants'),
         'enseignant' => $users,
         'typeStatus' => $typeStatus
      );
      return View::make('enseignant')->with($data);
    }

}