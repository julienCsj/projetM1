<?php
class EnseignantController extends BaseController {
	public function getEnseignants()
    {
        $data = array(
               'notifications' => array(),
                 'breadcrumb' => array('#ApplicationJaneDoe', 'Les enseignants'),
                 'enseignant' => array(
                    array('nom'=>'Chirac', 'prenom' => 'Jacques'),
                    array('nom'=>'Daniel', 'prenom' => 'Paul')
                  )
               );
        return View::make('enseignant')->with($data);
    }

}