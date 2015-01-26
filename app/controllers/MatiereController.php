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

    public function getMatieres()
    {
        $data = array(
               'notifications' => array(),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Matières & UE\'s')
               );
        return View::make('matiere')->with($data);
    }
}
