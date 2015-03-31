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
            $nbCoursParGroupeCours = array();
            foreach($groupesCours as $groupe) {
                $nbCoursParGroupeCours[$groupe->id] = DB::table('_groupecours_cours')->where('groupecoursID', '=', $groupe->id)->count();
            }
            $groupesCoursEnseignantModule = GroupeCoursEnseignantModule::get($idModule);
            $modules = Module::getModulesByFormation($idFormation);
            $periodes = Calendrier::getPeriodesEnseignement($idFormation);
            $cours = Cours::where('moduleID', '=', $idModule)->orderBy('type')->get();
            $typeCours = Cours::select(DB::raw('count(*) as nb, type, duree'))->where('moduleID', '=', $idModule)->where("dansGroupe", '=', 0)->groupBy('type', 'duree')->get();
            $typeCoursDansGroupe = Cours::select(DB::raw('count(*) as nb, type, duree'))->where('moduleID', '=', $idModule)->where('dansGroupe', '=', 1)->where('dansGroupeCommun','!=', 1)->groupBy('type', 'duree')->get();
            //$typeCoursDansGroupeCommun = Cours::select(DB::raw('count(*) as nb, type, duree, formationID, moduleID, ueID'))->where('moduleID', '=', $idModule)->where('dansGroupe', '=', 1)->where('dansGroupeCommun','=', 1)->groupBy('type', 'duree')->get();


            /*
             * La requete est longue mais elle est enf ait assez simple.
             * Comme les relations ne sont pas normalisées dans la BD existante,
             * il faut un peu tweeker pour retouver certaines infos.
             * Ici, plutot que d'essayer de récuperer l'id d'une formation et l'id d'une UE d'un
             * module, je vais directement chercher les informations dans la table cours.
             * Il s'agit donc de faire 3 sous requetes pour recuperer les 3 id puis de récupérer
             * l'ensemble des couples (type, durée) qui sont en commun avec un autre module pour un module donné.
             *
             * Tout ceci dans le but de proposer un lien qui menera a l'affectation du groupe source.
             */
            $typeCoursDansGroupeCommun = DB::select(DB::raw("
            select count(*) as nb, type, duree,
            (select c2.formationID
            from _cours c1, _cours c2, _groupecours_cours_encommun
            where c1.id = _groupecours_cours_encommun.coursID
            and c1.moduleID = '".$idModule."'
            and _groupecours_cours_encommun.moduleDst = c1.moduleID
            and _groupecours_cours_encommun.moduleSce = c2.moduleID
            limit 0,1) as formationID,
            (select c2.ueID
            from _cours c1, _cours c2, _groupecours_cours_encommun
            where c1.id = _groupecours_cours_encommun.coursID
            and c1.moduleID = '".$idModule."'
            and _groupecours_cours_encommun.moduleDst = c1.moduleID
            and _groupecours_cours_encommun.moduleSce = c2.moduleID
            limit 0,1) as ueID,
            (select c2.moduleID
            from _cours c1, _cours c2, _groupecours_cours_encommun
            where c1.id = _groupecours_cours_encommun.coursID
            and c1.moduleID = '".$idModule."'
            and _groupecours_cours_encommun.moduleDst = c1.moduleID
            and _groupecours_cours_encommun.moduleSce = c2.moduleID
            limit 0,1) as moduleID
            from _cours
            where moduleID = '".$idModule."'
            and dansGroupe = 1
            and dansGroupeCommun = 1
            group by type, duree "));

            $enseignants = ModuleEnseignant::getEnseignants($idModule);
            $financements = Financement::select('*')->orderBy("id", 'DESC')->get();
            

            $typeCoursMap = array();
            foreach($typeCours as $tc) {
                $typeCoursMap[$tc->type.'-'.$tc->duree] = $tc->nb;
            }

            $data['idFormation'] = $idFormation;
            $data['module'] = $module;
            $data['formation'] = $formation;
            $data['ue'] = $ue;
            $data['modules'] = $modules;
            $data['nbCoursParGroupeCours'] = $nbCoursParGroupeCours;
            $data['periodes'] = $periodes;
            $data['lesCours'] = $cours;
            $data['typeCours'] = $typeCours;
            $data['typeCoursDansGroupe'] = $typeCoursDansGroupe;
            $data['typeCoursDansGroupeCommun'] = $typeCoursDansGroupeCommun;
            $data['typeCoursMap'] = $typeCoursMap;
            $data['groupesCours'] = $groupesCours;
            $data['calendrier'] = Calendrier::where('idFormation', '=', $idFormation)->get();
            $data['enseignants'] = $enseignants;
            $data['financements'] = $financements;
            $data['groupesCoursEnseignantModule'] = $groupesCoursEnseignantModule;
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
        $enCommun = Input::get("enCommun");

        // Creation du groupe de cours
        $groupeCours = new GroupeCours();
        $groupeCours->moduleID = $idModule;
        $groupeCours->formationID = $idFormation;
        $groupeCours->libelle = $libelle;
        $groupeCours->save();

        // Recuperation de $nb Cours qui correspondent a ces critère
        $type = substr($type_duree,0, 2);
        $duree = substr($type_duree, 3);

        if($enCommun == "on") {
            $lesModules = Input::get('lesModulesEnCommun');
            // pour chaque module selectionné, mettre les flags dansGroupe et enCommun a 1
            foreach($lesModules as $module) {
                $lesCours = Cours::where('type', '=', $type)->where('duree', '=', $duree)->where('dansGroupe', "=", 0)->where("dansGroupeCommun", '=', 0)->where('moduleID', '=', "$module")->take($nb)->get();
                foreach($lesCours as $cours) {
                    $cours->dansGroupe = 1;
                    $cours->dansGroupeCommun = 1;
                    $cours->save();

                    DB::table('_groupecours_cours_encommun')->insert(
                        array('coursID' => $cours->id,
                            'groupecoursID' => $groupeCours->id,
                            'moduleSce' => $idModule,
                            'moduleDst' => $module)
                    );
                }
            }
            // Remplir la table des cours en commun

        }

        $lesCours = Cours::where('type', '=', $type)->where('duree', '=', $duree)->where('dansGroupe', "=", 0)->where('moduleID', '=', "$idModule")->take($nb)->get();
        foreach($lesCours as $cours) {
            $cours->dansGroupe = 1;
            $cours->dansGroupeCommun = 0;
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
            $unCours->dansGroupeCommun = 0;
            $unCours->save();
            DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours)->where('coursID', '=', $unCours->id)->delete();
        }

        // Cas des cours en commun
        $coursEnCommun = DB::table('_groupecours_cours_encommun')->where('groupecoursID', '=', $idGroupeCours)->get();
        foreach($coursEnCommun as $coursC) {
            $unCours = Cours::find($coursC->coursID);
            $unCours->dansGroupe = 0;
            $unCours->dansGroupeCommun = 0;
            $unCours->save();
            DB::table('_groupecours_cours_encommun')->where('groupecoursID', '=', $idGroupeCours)->where('coursID', '=', $unCours->id)->delete();
        }

        // Supprimer le groupe de cours
        $groupeCours = GroupeCours::find($idGroupeCours);
        $idFormation = $groupeCours->formationID;
        $groupeCours->delete();



        // Supprimer le groupe de cours de la planification
        DB::table('_planification')->where('groupecoursID', '=', $idGroupeCours)->delete();


        return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }



    public function ajouterLienGroupeCoursModuleEnseignant($idFormation = -1, $idUe = -1, $idModule = -1)
    {
        $enseignantGroupe = Input::get('enseignant-groupe');
        $financementGroupe = Input::get('financement-groupe');
        $idGroupeCours = Input::get('groupe_cours_id');

        // Supprime toutes les anciennes entrées de ce groupecours
        GroupeCoursEnseignantModule::where("groupecours_id", "=",$idGroupeCours)->delete();

        for ($i=0; $i < count($enseignantGroupe); $i++) { 
            $groupeCoursEnseignantModule = new GroupeCoursEnseignantModule();
            $groupeCoursEnseignantModule->groupecours_id = $idGroupeCours;
            $groupeCoursEnseignantModule->module_id = $idModule;
            $groupeCoursEnseignantModule->id_groupe = $i;
            $groupeCoursEnseignantModule->enseignant_id = $enseignantGroupe[$i];
            $groupeCoursEnseignantModule->financement_id = $financementGroupe[$i];
            $groupeCoursEnseignantModule->save();
        }

        return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }

    public function postAjaxCoursCommun() {
        $type_duree= Input::get("type");
        $nb = Input::get("nb");
        $idModuleAppelant = Input::get('idModule');

        $type = substr($type_duree,0, 2);
        $duree = substr($type_duree, 3);

        // Rechercher toutes les formations qui posséde des cours qui correspondent

        $idModulePossible = DB::table('_cours')
            ->select(DB::raw('count(id) as nbCours, moduleID'))
            ->where('moduleID', '!=', $idModuleAppelant)
            ->where('duree', '=', "$duree")
            ->where('type', '=', "$type")
            ->groupBy("moduleID")
            ->having('nbCours', '>=', $nb)
            ->get();

        /*
         *  select count(id) as nbCours, moduleID
            from `_cours`
            where `moduleID` != "mod00001"
            and `duree` = 60
            and `type` = "cm"
            group by moduleID
            having `nbCours` >= 2
         */
        /*var_dump($idModulePossible);
        exit();*/
        $lesModules = array();
        foreach($idModulePossible as $idMod) {
            $lesModules[] = Module::getModuleWithData($idMod->moduleID);
        }

        return $lesModules;
    }
}