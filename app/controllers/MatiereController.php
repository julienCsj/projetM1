<?php

class MatiereController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | IndexController
      |--------------------------------------------------------------------------
      |
      |
      |
      |
      |
      |
      |
     */

    //private $titre = "Proprietaire";

    public function getMatieres() {

        $lesFormations = Formation::getFormationUeModule();
        //var_dump($lesFormations);

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'Matières & UE\'s'),
            'lesFormations' => $lesFormations
        );
        return View::make('matiere')->with($data);
    }

}
