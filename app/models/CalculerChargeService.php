<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/03/15
 * Time: 10:29
 */

class CalculerChargeService {

   /* const SEC_PER_DAY = 60 * 60 * 24;
    const SEC_PER_WEEK = 60 * 60 * 24 * 7;*/

    public static function calculerServiceEnseignantGlobal($idEnseignant) {
        $resultEnHeure = array(
            "cm" => 0,
            "td" => 0,
            "tp" => 0,
        );

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS DANS LESQUELS L'ENSEIGNANT INTERVIENT
        $lesIdGroupesCoursOuLenseignantIntervient = DB::table('_groupecours_module_enseignant')
            ->select(DB::raw('distinct(groupecours_id) as groupecours_id'))
            ->where('enseignant_id', '=', $idEnseignant)
            ->get();

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursOuLenseignantIntervient as $idGroupeCours) {
            // RECUPERER LA DUREE ET LE TYPE DES COURS DE CE GC
            $unCoursDuGroupe = DB::table('_groupecours_cours')->select('coursID')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();

            $duree = Cours::find($unCoursDuGroupe->coursID)->duree;
            $type = Cours::find($unCoursDuGroupe->coursID)->type;
            $nbCoursDansGroupeCours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

            // RECUPERER LE NOMBRE DE GROUPE QUE L'ENSEIGNANT A A SA CHARGE
            $nbGroupeAssigneALenseignant = GroupeCoursEnseignantModule::where("enseignant_id" ,"=", $idEnseignant)
            ->where("groupecours_id", '=', $idGroupeCours->groupecours_id)->count();
            $resultEnHeure[$type] += $duree * $nbGroupeAssigneALenseignant * $nbCoursDansGroupeCours;
        }

        return $resultEnHeure;
    }

    public static function calculerServiceEnseignantParSemaine($idEnseignant) {
        // Recuperer tous les cours d'un prof

        return array();
    }

    public static function calculerServiceFormationGlobal($idFormation) {
        return array();
    }

    public static function calculerServiceFormationParSemaine($idFormation) {
        return array();
    }

    public static function getArrayWith52Weeks() {
        $weeks = array();
        for($i = 1; $i<=52; $i++) {
            $weeks[$i] = 0;
        }
        return $weeks;
    }
}