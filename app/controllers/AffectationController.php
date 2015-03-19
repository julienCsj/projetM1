<?php
class AffectationController extends BaseController {

    public function getAffectation()
    {
        $data = array(
            'lesFormations' => Formation::all(),
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Affectation',)
        );

        return View::make('affectation_choix_formation')->with($data);
    }

    public function getAffectationFormation($idFormation = -1, $idUe = -1, $idModule = -1)
    {
        // Pour remplir le menu dynamique
        $lesFormations = Formation::getFormationUeModule();
        $data = array("lesFormations" => $lesFormations,
            'breadcrumb' => array('Scolarel', 'Affectation'),
            'idFormation' => $idFormation);

        if($idFormation != -1) {
            $module = Module::getModuleWithData($idModule);
            $ue = Ue::getUeSimple($idUe);
            $formation = Formation::getFormationSimple($idFormation);


            $groupesCours = GroupeCours::getGroupeCoursByFormation($idFormation, $idModule);
            $modules = Module::getModulesByFormation($idFormation);
            $periodes = Calendrier::getPeriodesEnseignement($idFormation);
            $cours = Cours::where('moduleID', '=', $idModule)->orderBy('type')->get();
            $typeCours = Cours::select(DB::raw('count(*) as nb, type, duree'))->where('moduleID', '=', $idModule)->where("dansGroupe", '=', 0)->groupBy('type', 'duree')->get();
            $typeCoursDansGroupe = Cours::select(DB::raw('count(*) as nb, type, duree'))->where('moduleID', '=', $idModule)->where('dansGroupe', '=', 1)->groupBy('type', 'duree')->get();
            $enseignants = ModuleEnseignant::getEnseignants($idModule);
            

            $typeCoursMap = array();
            foreach($typeCours as $tc) {
                echo $tc->type.'-'.$tc->duree;
                echo '<br>';
                $typeCoursMap[$tc->type.'-'.$tc->duree] = $tc->nb;
            }


            $data['idFormation'] = $idFormation;
            $data['module'] = $module;
            $data['formation'] = $formation;
            $data['ue'] = $ue;
            $data['modules'] = $modules;
            $data['periodes'] = $periodes;
            $data['lesCours'] = $cours;
            $data['typeCours'] = $typeCours;
            $data['typeCoursDansGroupe'] = $typeCoursDansGroupe;
            $data['typeCoursMap'] = $typeCoursMap;
            $data['groupesCours'] = $groupesCours;
            $data['calendrier'] = Calendrier::where('idFormation', '=', $idFormation)->get();
            $data['enseignants'] = $enseignants;
        }

        return View::make('affectation')->with($data);
    }

    public function ajouterGroupeCours()
    {
        $idFormation = Input::get('idFormation');
        $idModule = Input::get('idModule');
        $idUe = Input::get('idUe');

        $type_duree = Input::get('type');
        $nb = Input::get('nb');
        $libelle = Input::get('libelle');

        // Creation du groupe de cours
        $groupeCours = new GroupeCours();
        $groupeCours->moduleID = $idModule;
        $groupeCours->formationID = $idFormation;
        $groupeCours->libelle = $libelle;
        $groupeCours->save();

        // Recuperation de $nb Cours qui correspondent a ces critère
        $type = substr($type_duree,0, 2);
        $duree = substr($type_duree, 3);


        $lesCours = Cours::where('type', '=', $type)->where('duree', '=', $duree)->where('dansGroupe', "=", 0)->take($nb)->get();
        foreach($lesCours as $cours) {
            $cours->dansGroupe = 1;
            $cours->save();

            DB::table('_groupecours_cours')->insert(
                array('coursID' => $cours->id,
                      'groupecoursID' => $groupeCours->id)
            );
        }
        return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }

    public function supprimerGroupeCours($idFormation = -1, $idUe = -1, $idModule = -1, $idGroupeCours)
    {
        // De-valider les cours qui appartienne a ce groupe de cours
        $cours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours)->get();

        foreach($cours as $c) {
            $unCours = Cours::find($c->coursID);
            $unCours->dansGroupe = 0;
            $unCours->save();
            DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours)->where('coursID', '=', $unCours->id)->delete();
        }
        // Supprimer le groupe de cours
        $groupeCours = GroupeCours::find($idGroupeCours);
        $idFormation = $groupeCours->formationID;
        $groupeCours->delete();

        return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }
}