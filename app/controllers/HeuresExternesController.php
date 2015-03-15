<?php
class HeuresExternesController extends BaseController {
    public function getHeuresExternes()
    {
        // Récuperer les heures externes d'un enseignant



        return View::make('heures_externes')->with($data);
    }

    public function postAjouterHeure()
    {


    }

    public function getSupprimerHeure($idHeure){

    }
}




