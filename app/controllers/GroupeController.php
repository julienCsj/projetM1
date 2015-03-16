<?php
class GroupeController extends BaseController {

    public function getGroupes($idFormation = -1) {
        $lesFormations = Formation::getFormationUeModule();

        $data = array(
            'notifications' => array(),
            'lesFormations' => $lesFormations,
            'idFormation' => $idFormation,
            'breadcrumb' => array('Scolarel', 'Gestion des groupes')
        );

        // Si une formation a été selectionnée par l'utilisateur, alors on récupère ses informations
        if($idFormation != -1) {
            $formation = Formation::getFormationSimple($idFormation);
            $groupes = Groupe::getGroupesByFormation($idFormation);

            $data['formation'] = $formation;
            $data['breadcrumb'] = array('Scolarel', 'Gestion des groupes', $formation->long_title);
            $data['groupes'] = $groupes;
        }

        return View::make('groupeV2')->with($data);
    }


    public function supprimerGroupe($idFormation, $idGroupe)
    {
        $groupe = Groupe::find($idGroupe);
        $groupe->delete();
        return Redirect::route('groupeModification', array('idFormation' => $idFormation));    }

    public function ajouterGroupe()
    {
        $idFormation = Input::get('idFormation');
        $groupe = new Groupe();
        $groupe->nom = Input::get('nom');
        $groupe->sous_groupe = Input::get('sous_groupe');
        $groupe->semestre_id = $idFormation;
        $groupe->save();
        return Redirect::route('groupeModification', array('idFormation' => $idFormation));
    }

    public function modifierGroupe()
    {
        $idFormation = Input::get('idFormation');
        $idGroupe = Input::get('idGroupe');
        $groupe = Groupe::find($idGroupe);
        $groupe->nom = Input::get('nom');
        $groupe->sous_groupe = Input::get('sous_groupe');
        $groupe->save();
        return Redirect::route('groupeModification', array('idFormation' => $idFormation));
    }

}