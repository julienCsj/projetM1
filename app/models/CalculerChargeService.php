<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/03/15
 * Time: 10:29
 */

class CalculerChargeService {

    const SEC_PER_DAY = 60 * 60 * 24;
    const SEC_PER_WEEK = 60 * 60 * 24 * 7;

    public static function calculerServiceEnseignantGlobal($idEnseignant) {
        $resultEnHeure = array(
            "cm" => 0,
            "td" => 0,
            "tp" => 0,
        );

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS DANS LESQUELS L'ENSEIGNANT INTERVIENT
        $lesIdGroupesCoursOuLenseignantIntervient = array();
        
        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursOuLenseignantIntervient as $gc) {
            // RECUPERER LA DUREE ET LE TYPE DES COURS DE CE GC
            $duree = 0;
            $type = "";

            $resultEnHeure[$type] += $duree;
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