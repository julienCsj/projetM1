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
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Les Matieres & UEs',
                   'message' => 'Bienvenue sur #ApplicationSansNom<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Matières & UE\'s')
               );
        return View::make('matiere')->with($data);
    }
}
