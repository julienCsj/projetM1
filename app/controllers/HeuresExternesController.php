<?php
class HeuresExternesController extends BaseController {
    public function getHeuresExternes()
    {
        // Récuperer les heures externes d'un enseignant
        $lesHeures = HeureExterne::where('enseignantID', '=', Session::get("user")->LOGIN)->get();
        $data = array(
            'lesHeures' => $lesHeures,
            'breadcrumb' => array("Scolarel", "Heures exterieures")
        );

        return View::make('heures_externes')->with($data);
    }

    public function postAjouterHeure()
    {
        $heure = new HeureExterne();
        $heure->libelle = Input::get("libelle");
        $heure->nbHeure = Input::get("nbHeure");
        $heure->type = Input::get("type");
        $heure->enseignantID = Input::get("enseignantID");
        $heure->save();

        return Redirect::route('heuresexterieures');    }

    public function getSupprimerHeure($idHeure){
        HeureExterne::where("id", '=', $idHeure)->delete();

        return Redirect::route('heuresexterieures');
    }
}



