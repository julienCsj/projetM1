<?php
class CalendrierController extends BaseController {
	public function getCalendrier()
    {
        $data = array(
            'lesFormations' => Formation::all(),
               'notifications' => array(),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Le calendrier')
               );


        //exit(var_dump($data));
        return View::make('calendrier_choix_formation')->with($data);
    }

    public function getCalendrierFormation($idFormation) {
        $data = array('idFormation' => $idFormation,
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'Le calendrier'),
            'formation' => Formation::find($idFormation),
            'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());

        return View::make('calendrier')->with($data);
    }

    public function postAjouterPeriode() {
        $calendrier = new Calendrier();
        $calendrier->nom = Input::get("nom");
        $calendrier->dateDebut = Input::get('dateDebut');
        $calendrier->dateFin = Input::get('dateFin');
        $calendrier->idFormation = Input::get('idFormation');
        $calendrier->save();

        return "Ok";
    }

}