<?php
class CalendrierController extends BaseController {
	public function getCalendrier()
    {
        $data = array(
            'lesFormations' => Formation::all(),
               'notifications' => array(),
                 'breadcrumb' => array('Scolarel', 'Calendriers')
               );


        //exit(var_dump($data));
        return View::make('calendrier_choix_formation')->with($data);
    }

    public function getCalendrierFormation($idFormation) {
        $formation = Formation::find($idFormation)
                ->join('pages', 'pages.id', '=', 'semestre.id')
                ->select('semestre.id', 'pages.short_title', 'pages.long_title')->firstOrFail();
        $data = array('idFormation' => $idFormation,
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', array("link"=> URL::route('calendrier'),"label"=>'Calendriers'), $formation->long_title),
            'formation' => $formation,
            'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());

        return View::make('calendrier')->with($data);
    }

    public function postAjouterPeriode() {
        $calendrier = new Calendrier();
        $calendrier->nom = Input::get("nom");
        $calendrier->dateDebut = Input::get('dateDebut');
        $calendrier->dateFin = Input::get('dateFin');
        $calendrier->idFormation = Input::get('idFormation');
        $calendrier->type = Input::get("type");
        $calendrier->save();
        return "Ok";
    }

    public function postModifierPeriode() {
        $idFormation = Input::get('idFormation');
        $nom = Input::get("nom");

        $calendrier = Calendrier::where('idFormation', '=', $idFormation)->where('nom', '=', $nom)->firstOrFail();
        $calendrier->dateFin = Input::get('dateFin');
        $calendrier->save();
        return "Ok";
    }

}