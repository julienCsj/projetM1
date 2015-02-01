<?php
class GroupeController extends BaseController {
	public function getGroupes()
    {
        $lesFormations = Formation::getFormationUeModule();

        $data = array(
                'notifications' => array(),
                'lesFormations' => $lesFormations,
                'breadcrumb' => array('#ApplicationJaneDoe', 'Les formations')
               );
        return View::make('groupe')->with($data);
    }

}