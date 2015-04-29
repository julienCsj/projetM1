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
        $heure->intitule = Input::get("intitule");
        $heure->etablissement = Input::get("etablissement");
        $heure->numeroUE = Input::get("numeroUE");
        $heure->diplome = Input::get("diplome");
        $heure->type = Input::get("type");
        $heure->nbHeureCM = Input::get("nbHeureCM");
        $heure->nbHeureTD = Input::get("nbHeureTD");
        $heure->nbHeureTP = Input::get("nbHeureTP");
        $heure->enseignantID = Input::get("enseignantID");
        $heure->save();

        if(Input::has("fromFiche")) {
            return Redirect::route('generationFicheProf', array("idEnseignant" => $heure->enseignantID));
        }
        return Redirect::route('heuresexterieures');
    }

    public function getSupprimerHeure($idHeure){
        HeureExterne::where("id", '=', $idHeure)->delete();

        return Redirect::route('heuresexterieures');
    }
}



