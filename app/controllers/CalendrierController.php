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
            'calendrier' => Calendrier::getCalendrierFormation($idFormation));

        return View::make('calendrier')->with($data);
    }

}