<?php
class VoeuxController extends BaseController {
	public function getVoeux() {
        $user = Session::get('user');
        $voeux = Voeux::getVoeux($user->LOGIN);
		$data = array(
		    'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Voeux enseignant'),
			'voeux' => $voeux,
		 );
		return View::make('voeux')->with($data);
	}
	public function editVoeux() {
        $user = Session::get('user');
        $_idEnseignant = $user->LOGIN;
        $_dispo = intval(Input::get('dispo'));
        $_jour = intval(Input::get('jour'));
        $_creneau = intval(Input::get('creneau'));

        if ($_dispo == 0) {
            // ajouter une ligne
            $voeux = new Voeux();
            $voeux->enseignant_id = $_idEnseignant;
            $voeux->jour = $_jour;
            $voeux->creneau = $_creneau;
            $voeux->save();
        } else {
            // supprimer
            Voeux::supprimerVoeux($_idEnseignant, $_jour, $_creneau);
        }
        return "Ok";
	}
    public function getVoeuxProfesseur($idProfesseur) {
        $voeux = Voeux::getVoeux($idProfesseur);
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', array("label"=> 'Gestion des enseignants',"link"=>"/enseignant"),'Voeux enseignant'),
            'voeux' => $voeux,
         );
        return View::make('voeux_professeur')->with($data);
    }
}