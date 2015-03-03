<?php

class MatiereController extends BaseController {

    public function getMatieres() {

        $lesFormations = Formation::getFormationUeModule();
        //exit(var_dump($lesFormations));

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Matières & UE\'s'),
            'lesFormations' => $lesFormations
        );
        return View::make('matiere')->with($data);
    }

    public function modifierMatiere($idFormation, $idMatiere) {
        $matiere = Module::getModuleWithData($idMatiere);
        $financement = Financement::all();
        $enseignants = Enseignant::getEnseignantAndStatus();

        $data = array(
            'breadcrumb' => array('Scolarel', array("link"=> URL::route('matiere'),"label"=>'Matières & UE\'s'), $matiere->LONG_TITLE),
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
                'CM_60' => Input::get('heureCM60'),
                'CM_90' => Input::get('heureCM90'),
                'CM_120' => Input::get('heureCM120'),
                'TD_60' => Input::get('heureTD60'),
                'TD_90' => Input::get('heureTD90'),
                'TD_120' => Input::get('heureTD120'),
                'TP_60' => Input::get('heureTP60'),
                'TP_90' => Input::get('heureTP90'),
                'TP_120' => Input::get('heureTP120')));

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
