<?php

class ModuleController extends BaseController {


    public function getModules($idFormation = -1, $idUe = -1, $idModule = -1) {
        $lesFormations = Formation::getFormationUeModule();

        $data = array(
            'notifications' => array(),
            'lesFormations' => $lesFormations,
            'idModule' => $idModule,
            'idFormation' => $idFormation,
            'idUe' => $idUe,
            'breadcrumb' => array('Scolarel', 'Formations, Ue\'s & modules')
        );

        // Si un module a été selectionné par l'utilisateur, alors on récupère ses informations
        if($idModule != -1) {
            $module = Module::getModuleWithData($idModule);
            $ue = Ue::getUeSimple($idUe);
            $formation = Formation::getFormationAvecGroupes($idFormation);

            //exit(var_dump($formation));
            $data['module'] = $module;
            $data['formation'] = $formation;
            $data['ue'] = $ue;
            $data['lesFinancements'] = Financement::all();
            $data['lesEnseignants'] = Enseignant::getEnseignantAndStatus();
            $data['lesCours'] = Cours::where('moduleID', '=', $idModule)->get();
            $data['breadcrumb'] = array('Scolarel', 'Formations, Ue\'s & modules', $formation->long_title, $ue->long_title, $module->LONG_TITLE);

            $heureCM = 0;
            $heureTD = 0;
            $heureTP = 0;
            foreach($data['lesCours'] as $c) {
                switch($c->type) {
                    case "cm" :
                        $heureCM += $c->duree;
                        break;
                    case "td" :
                        $heureTD += $c->duree;
                        break;
                    case "tp" :
                        $heureTP += $c->duree;
                        break;
                }
            }
            // Calcul des totaux pour les CM, TD, TP
            $data['totalCM'] = floor($heureCM / 60)."h".$heureCM % 60;
            if($heureCM % 60 == 0) $data['totalCM'].= 0;
            $data['totalTD'] = floor($heureTD / 60)."h".$heureTD % 60;
            if($heureTD % 60 == 0) $data['totalTD'].= 0;
            $data['totalTP'] = floor($heureTP / 60)."h".$heureTP % 60;
            if($heureTP % 60 == 0) $data['totalTP'].= 0;
        }

        //exit(var_dump($data['module']->lesFinancements));
        return View::make('module')->with($data);
    }

    public function postModifierModule() {

        $idFormation = Input::get('idFormation');
        $idModule = Input::get('idModule');
        $idUe = Input::get('idUe');
        $nb = Input::get('nb');
        $type = Input::get('type');
        $duree = Input::get('duree');



        $lesEnseignants = Input::get('lesEnseignants');
        if(!empty($lesEnseignants)) {
            foreach($lesEnseignants as $enseignant) {
                Module::ajouterEnseignant($enseignant, $idModule);
            }
        }

        $lesFinancements = Input::get('lesFinancements');
        if(!empty($lesFinancements)) {
            foreach ($lesFinancements as $financement) {
                Module::ajouterFinancement($financement, $idModule);
            }
        }

        DB::table('module')
            ->where('ID', $idModule)
            ->update(array('GROUPE_CM' => Input::get("groupeCM"),
                'GROUPE_TD' => Input::get("groupeTD"),
                'GROUPE_TP' => Input::get("groupeTP"),
               ));

        for($i=0; $i<$nb; $i++){
            $cours = new Cours;
            $cours->type = $type;
            $cours->duree = $duree;
            $cours->moduleID = $idModule;
            $cours->formationID = $idFormation;
            $cours->ueID = $idUe;
            $cours->dansGroupe = 0;
            $cours->planifier = 0;
            $cours->save();
        }

        return Redirect::route('moduleModification', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));

    }

    public function supprimerEnseignantModule($idFormation, $idUe,  $idModule, $idEnseignant) {
        Module::supprimerUnEnseignant($idModule, $idEnseignant);
        return Redirect::route('moduleModification', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }

    public function supprimerFinancementModule($idFormation, $idUe, $idModule, $idFinancement) {
        Module::supprimerUnFinancement($idModule, $idFinancement);
        return Redirect::route('moduleModification', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }

    public function supprimerCours($idFormation, $idUe, $idModule, $idCours) {
        $result = Cours::where('id', '=', $idCours)->delete();
        return Redirect::route('moduleModification', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));
    }
}
