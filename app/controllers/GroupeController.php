<?php
class GroupeController extends BaseController {
	public function getGroupes()
  {
      $lesGroupes = Groupe::getGroupeModule();

      $data = array(
              'notifications' => array(),
              'lesGroupes' => $lesGroupes,
              'breadcrumb' => array('#ApplicationJaneDoe', 'Les formations')
             );

      return View::make('groupe')->with($data);
  }

}