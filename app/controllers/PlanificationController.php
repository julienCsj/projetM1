<?php
class PlanificationController extends BaseController {

    public function getPlanification()
    {
        $data = array(
            'lesFormations' => Formation::all(),
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Affectation')
        );

        return "TODO Ecrire le controlleur";
        //return View::make('affectation_choix_formation')->with($data);
    }
}