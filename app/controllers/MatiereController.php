<?php

class MatiereController extends BaseController {

    public function getMatieres() {

        $lesFormations = Formation::getFormationUeModule();
        //exit(var_dump($lesFormations));

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'Matières & UE\'s'),
            'lesFormations' => $lesFormations
        );
        return View::make('matiere')->with($data);
    }

    public function modifierMatiere($idFormation, $idMatiere) {
        $matiere = Module::getModuleWithData($idMatiere);
        $financement = Financement::all();
        $enseignants = User::getEnseignant();

        $data = array(
            'breadcrumb' => array('#ApplicationJaneDoe', 'Matières & UE\'s'),
            'matiere' => $matiere,
            'lesFinancements' => $financement,
            'idFormation' => $idFormation,
            'lesEnseignants' => $enseignants);

        //exit(var_dump($data));
        return View::make('modifier_matiere')->with($data);
    }

    public function postModifierMatiere() {

        $idFormation = Input::get('idFormation');
        $idMatiere = Input::get('idMatiere');

        /*Module::supprimerFinancement($idMatiere);
        Module::supprimerEnseignant($idMatiere);*/

        $lesEnseignants = Input::get('lesEnseignants');
        if(!empty($lesEnseignants)) {
            foreach($lesEnseignants as $enseignant) {
                Module::ajouterEnseignant($enseignant, $idMatiere);
            }
        }

        $lesFinancements = Input::get('lesFinancements');
        if(!empty($lesFinancements)) {
            foreach ($lesFinancements as $financement) {
                Module::ajouterFinancement($financement, $idMatiere);
            }
        }

        DB::table('module')
            ->where('ID', $idMatiere)
            ->update(array('GROUPE_CM' => Input::get("groupeCM"),
                'GROUPE_TD' => Input::get("groupeTD"),
                'GROUPE_TP' => Input::get("groupeTP"),
                'CM_REEL' => Input::get('heureCM'),
                'TD_REEL' => Input::get('heureTD'),
                'TP_REEL' => Input::get('heureTP')));

        return Redirect::route('matiere.modifier', array('idFormation' => $idFormation, 'idMatiere' => $idMatiere));

    }

    public function supprimerEnseignantMatiere($idFormation, $idMatiere, $idEnseignant) {
        Module::supprimerUnEnseignant($idMatiere, $idEnseignant);
        return Redirect::route('matiere.modifier', array('idFormation' => $idFormation, 'idMatiere' => $idMatiere));
    }

    public function supprimerFinancementMatiere($idFormation, $idMatiere, $idFinancement) {
        Module::supprimerUnFinancement($idMatiere, $idFinancement);
        return Redirect::route('matiere.modifier', array('idFormation' => $idFormation, 'idMatiere' => $idMatiere));
    }
}
