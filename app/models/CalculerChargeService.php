<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/03/15
 * Time: 10:29
 */

class CalculerChargeService {


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
        // Récuperation de l'array contenant les 52 semaines
        $arraySemaine = CalculerChargeService::getArrayWith52Weeks();

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS DANS LESQUELS L'ENSEIGNANT INTERVIENT
        $lesIdGroupesCoursOuLenseignantIntervient = DB::table('_groupecours_module_enseignant')
            ->select(DB::raw('distinct(groupecours_id) as groupecours_id'))
            ->where('enseignant_id', '=', $idEnseignant)
            ->get();

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursOuLenseignantIntervient as $idGroupeCours) {

            $estPlanifier = DB::table('_planification')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

            // Si le groupe de cours a été planifié
            if($estPlanifier > 0)
            {
                // Récuperer la période qui correspond au groupe_cours
                $idPeriode = DB::table('_planification')
                    ->select(DB::raw('calendrierID'))
                    ->where('groupecoursID', '=', $idGroupeCours->groupecours_id)
                    ->first();

                $periode = Calendrier::find($idPeriode->calendrierID);

                // Réupérer la date de début période sous forme de timestamp (pour faciliter les calculs)
                $dateDebutPeriode = strtotime($periode->dateDebut);

                // ETAPE 3 : Deux cas possible, soit le nombre de cours de la période = nombre de semaine (un cours par semaine)
                //           soit le nombre de cours est inferieur au nombre de semaine (il y a un décalage)
                $extractWeek = PeriodeToSemaineService::extractWeeksFromPeriod($periode);
                $extractWeek = $extractWeek["sem"];
                $nbSemainePeriode = count($extractWeek);

                $nbCoursDansGroupeCours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

                // Calculer le numéro de la premiere semaine
                $numeroSemaine = CalculerChargeService::timestampToWeek($dateDebutPeriode);

                // RECUPERER LA DUREE ET LE TYPE DES COURS DE CE GC
                $unCoursDuGroupe = DB::table('_groupecours_cours')->select('coursID')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();

                $duree = Cours::find($unCoursDuGroupe->coursID)->duree;
                $type = Cours::find($unCoursDuGroupe->coursID)->type;
                $nbCoursDansGroupeCours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

                // RECUPERER LE NOMBRE DE GROUPE QUE L'ENSEIGNANT A A SA CHARGE
                $nbGroupeAssigneALenseignant = GroupeCoursEnseignantModule::where("enseignant_id" ,"=", $idEnseignant)
                    ->where("groupecours_id", '=', $idGroupeCours->groupecours_id)->count();

                if ($nbCoursDansGroupeCours == $nbSemainePeriode) {
                    // Attribuer un cours a chaque semaine
                    for($i=1; $i <=$nbCoursDansGroupeCours; $i++) {
                        $arraySemaine[intval($i+$numeroSemaine-1)][$type] += $duree * $nbGroupeAssigneALenseignant;
                        echo "Semaine ".intval($i+$numeroSemaine-1)." : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                    }

                } else {
                    // Récuperer le décallage de début de période
                    $decalage = DB::table('_planification')->select('semaine')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();
                    $decalage = intval($decalage->semaine);

                    // Attribuer un cours par semaine a partir du décallage
                    for($i=$decalage; $i <=$nbCoursDansGroupeCours+($decalage-1); $i++) {
                        echo "Semaine ".intval($i+$numeroSemaine-1)." ($decalage) : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                        $arraySemaine[intval($i+$numeroSemaine-1)][$type] += $duree * $nbGroupeAssigneALenseignant;
                    }

                }
            }
        }
        return $arraySemaine;
    }

    public static function timestampToWeek($t) {
        return date("W", $t+7200);
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
            $weeks[$i] = array(
                'cm' => 0,
                'td' => 0,
                'tp' => 0);
        }
        return $weeks;
    }

    public static function minuteToHourInArray($array) {

    }
}