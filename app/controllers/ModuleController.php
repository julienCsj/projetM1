<?php

class ModuleController extends BaseController {


    public function getModules($idFormation = -1, $idUe = -1, $idModule = -1) {
        $lesFormations = Formation::getFormationUeModule();

        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Matières & UE\'s'),
            'lesFormations' => $lesFormations,
            'idModule' => $idModule,
            'idFormation' => $idFormation,
            'idUe' => $idUe
        );

        // Si un module a été selectionner par l'utilisateur, alors on récupère ses informations
        if($idModule != -1) {
            $data['module'] = Module::getModuleWithData($idModule);
            $data['lesFinancements'] = Financement::all();
            $data['lesEnseignants'] = Enseignant::getEnseignantAndStatus();
            $data['lesCours'] = Cours::where('moduleID', '=', $idModule)->get();

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
            $data['totalCM'] =  floor($heureCM / 60)."h".$heureCM % 60;
            $data['totalTD'] = floor($heureTD / 60)."h".$heureTD % 60;
            $data['totalTP'] = floor($heureTP / 60)."h".$heureTP % 60;
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
            $cours->save();
        }

        return Redirect::route('moduleModification', array('idFormation' => $idFormation, 'idUe' => $idUe, 'idModule' => $idModule));

    }

    public function supprimerEnseignantModule($idFormation, $idUe,  $idModule, $idEnseignant) {
        $idFormation = Input::get('idFormation');
        $idModule = Input::get('idModule');
        $idUe = Input::get('idUe');
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
