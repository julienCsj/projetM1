<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/03/15
 * Time: 10:29
 */

class CalculerChargeService {

    public static function computeNumeroSemaine($i, $numeroSemaine) {
        $indice = intval(($i+$numeroSemaine-1)%52);
        if($indice == 0)
            return 52;
        else
            return $indice;
    }

    public static function calculerServiceEnseignantGlobal($idEnseignant, $config, $palierEnseignantHeure) {
        $palierEnseignant = $palierEnseignantHeure*60;
        $resultEnMin = array(
            "cm" => 0,
            "td" => 0,
            "tp" => 0
        );

        // ETAPE 1 : RECUPERER LE RESULTAT PAR TYPE PAR SEMAINE
        $serviceParSemaine = CalculerChargeService::calculerServiceEnseignantParSemaine($idEnseignant);

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        $types = array("cm", "td", "tp");
        foreach($serviceParSemaine as $sem) {
            // itere sur les types de cours
            foreach ($types as $type) {
                if ($sem[$type] != 0) {
                    // Gere le nombre d'heure en HCC et le total des heures par type
                    $resultEnMin[$type] += $sem[$type];
                }
            }
        }

        $total = $resultEnMin["cm"] + $resultEnMin["td"] + $resultEnMin["tp"];
        foreach($resultEnMin as $k => $v) {
            $resultEnMin[$k . "_pourc"] = $v / $total;
            $resultEnMin[$k] = $v / 60; // transforme les mins en heures
        }

        return $resultEnMin;
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
                        $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][$type] += $duree * $nbGroupeAssigneALenseignant;
                        //echo "Semaine ".intval($i+$numeroSemaine-1)." : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                    }

                } else {
                    // Récuperer le décallage de début de période
                    $decalage = DB::table('_planification')->select('semaine')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();
                    $decalage = intval($decalage->semaine);

                    // Attribuer un cours par semaine a partir du décallage
                    for($i=$decalage; $i <=$nbCoursDansGroupeCours+($decalage-1); $i++) {
                        //echo "Semaine ".intval($i+$numeroSemaine-1)." ($decalage) : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                        $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][$type] += $duree * $nbGroupeAssigneALenseignant;
                    }

                }
            }
        }
        return CalculerChargeService::minuteToHourInArray($arraySemaine);
    }

    public static function timestampToWeek($t) {
        return date("W", $t+7200);
    }

    public static function calculerServiceFormationGlobal($idFormation) {
        $resultEnHeure = array(
            "cm" => 0,
            "td" => 0,
            "tp" => 0,
        );

        $lesFormations = Formation::getFormationUeModule();
        foreach($lesFormations as $f) {
            if($f->id == $idFormation) {
                foreach($f->lesUE as $ue) {
                    foreach($ue->lesModules as $mod) {
                        $serviceModule = CalculerChargeService::calculerServiceModuleGlobal($mod->ID);
                        $resultEnHeure['cm'] += $serviceModule['cm'];
                        $resultEnHeure['td'] += $serviceModule['td'];
                        $resultEnHeure['tp'] += $serviceModule['tp'];
                    }
                }
            }
        }
        return $resultEnHeure;
    }

    public static function calculerServiceModuleGlobal($idModule) {
        $resultEnHeure = array(
            "cm" => 0,
            "td" => 0,
            "tp" => 0,
        );

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS POUR UNE FORMATION
        $lesIdGroupesCoursDeLaFormation = DB::table('_groupecours')
            ->select(DB::raw('id as groupecours_id'))
            ->where('moduleID', '=', $idModule)
            ->get();

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursDeLaFormation as $idGroupeCours) {
            // RECUPERER LA DUREE ET LE TYPE DES COURS DE CE GC
            $unCoursDuGroupe = DB::table('_groupecours_cours')->select('coursID')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();

            $duree = Cours::find($unCoursDuGroupe->coursID)->duree;
            $type = Cours::find($unCoursDuGroupe->coursID)->type;
            $nbCoursDansGroupeCours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

            $resultEnHeure[$type] += $duree * $nbCoursDansGroupeCours;

        }

        // Recuperer les eventuels cours en commun
        $lesIdCoursEnCommun = DB::table('_groupecours_cours_encommun')->where('moduleDst', '=', $idModule)->get();
        foreach($lesIdCoursEnCommun as $c) {
            $duree = Cours::find($c->coursID)->duree;
            $type = Cours::find($c->coursID)->type;
            $resultEnHeure[$type] += $duree;
        }

        return $resultEnHeure;
    }

    public static function calculerServiceFormationParSemaine($idFormation) {
        // Récuperation de l'array contenant les 52 semaines
        $arraySemaine = CalculerChargeService::getArrayWith52Weeks();

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS POUNR UNE FORMATION
        $lesIdGroupesCoursDeLaFormation = DB::table('_groupecours')
            ->select(DB::raw('id as groupecours_id'))
            ->where('formationID', '=', $idFormation)
            ->get();

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursDeLaFormation as $idGroupeCours) {

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


                if ($nbCoursDansGroupeCours == $nbSemainePeriode) {
                    // Attribuer un cours a chaque semaine
                    for($i=1; $i <=$nbCoursDansGroupeCours; $i++) {
                        $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][$type] += $duree;
                        //echo "Semaine ".intval($i+$numeroSemaine-1)." : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                    }

                } else {
                    // Récuperer le décallage de début de période
                    $decalage = DB::table('_planification')->select('semaine')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();
                    $decalage = intval($decalage->semaine);

                    // Attribuer un cours par semaine a partir du décallage
                    for($i=$decalage; $i <=$nbCoursDansGroupeCours+($decalage-1); $i++) {
                        //echo "Semaine ".intval($i+$numeroSemaine-1)." ($decalage) : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                        $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][$type] += $duree;
                    }
                }
            }
        }
        return CalculerChargeService::minuteToHourInArray($arraySemaine);
    }

    public static function getArrayWith52Weeks() {

        $annee = new Calendrier();
        $annee->nom = "Annee scolaire";
        $annee->dateDebut = Configuration::find(1)->dateRentree;
        $annee->dateFin = Configuration::find(1)->dateFin;

        $sem = PeriodeToSemaineService::extractWeeksFromPeriod($annee)['sem'];
        $nbSem = count($sem);

        $weeks = array();
        for($i=0; $i<$nbSem; $i++){
            $weeks[intval($sem[$i]['semaine'])] = array(
                'numSemaine' => $sem[$i]['semaine'],
                'annee' => $sem[$i]['annee'],
                'label' => $sem[$i]['label'],
                'cm' => 0,
                'td' => 0,
                'tp' => 0);
        }
        return $weeks;
    }

    public static function minuteToHourInArray($array) {
        foreach($array as $s) {
            $minCM = $s['cm'];
            $s['cm'] = array('h' => floor($minCM / 60), 'm' => $minCM%60);
            $minTD = $s['td'];
            $s['td'] = array('h' => floor($minTD / 60), 'm' => $minTD%60);
            $minTP = $s['tp'];
            $s['tp'] = array('h' => floor($minTP / 60), 'm' => $minTP%60);
        }
        return $array;
    }

    public static function convertToHoursMins($time, $format = '%d:%d') {
        settype($time, 'integer');
        if ($time < 1) {
            return;
        }
        $ret = array();
        $ret['h'] = floor($time / 60);
        $ret['m'] = ($time % 60);
        return $ret;
    }

    public static function genererEmploiDuTempsFormation($idFormation) {
        // Récuperation de l'array contenant les 52 semaines
        $arraySemaine = CalculerChargeService::getArrayWith52Weeks();

        // ETAPE 1 : RECUPERER L'ENSEMBLE DES GROUPE_COURS DANS LESQUELS L'ENSEIGNANT INTERVIENT
        $lesIdGroupesCoursDeLaFormation = DB::table('_groupecours')
            ->select(DB::raw('id as groupecours_id'))
            ->where('formationID', '=', $idFormation)
            ->get();

        // ETAPE 2 : POUR CHAQUE GROUPE DE COURS
        foreach($lesIdGroupesCoursDeLaFormation as $idGroupeCours) {

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
                $titreModule = Module::getModuleWithData(Cours::find($unCoursDuGroupe->coursID)->moduleID)->SHORT_TITLE;
                $nbCoursDansGroupeCours = DB::table('_groupecours_cours')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->count();

                $enseignantGroupe = DB::table('_groupecours_module_enseignant')
                                        ->select(DB::raw("count(*) as nb_groupe, enseignant_id, firstname, lastname "))
                                        ->where('groupecours_id', '=', $idGroupeCours->groupecours_id)
                                        ->join("user", '_groupecours_module_enseignant.enseignant_id', '=', 'user.login')
                                        ->groupBy("enseignant_id")
                                        ->get();


                if ($nbCoursDansGroupeCours == $nbSemainePeriode) {
                    // Attribuer un cours a chaque semaine
                    for($i=1; $i <=$nbCoursDansGroupeCours; $i++) {
                        $repartition = array();
                        foreach($enseignantGroupe as $eg) {
                            $repartition[] = ucfirst($eg->firstname). " ". ucfirst($eg->lastname) . " pour $eg->nb_groupe groupe(s)";
                        }
                        $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][]
                            = array("[$titreModule] $type de $duree min.<br />",
                            $repartition);
                    }

                } else {
                    // Récuperer le décallage de début de période
                    $decalage = DB::table('_planification')->select('semaine')->where('groupecoursID', '=', $idGroupeCours->groupecours_id)->first();
                    $decalage = intval($decalage->semaine);

                    // Attribuer un cours par semaine a partir du décallage
                    for($i=$decalage; $i <=$nbCoursDansGroupeCours+($decalage-1); $i++) {
                        $repartition = array();
                        foreach($enseignantGroupe as $eg) {
                            $repartition[] = ucfirst($eg->firstname). " ". ucfirst($eg->lastname) . " pour $eg->nb_groupe groupe(s)";
                        }
                        //echo "Semaine ".intval($i+$numeroSemaine-1)." ($decalage) : $type de $duree min * $nbGroupeAssigneALenseignant <br />";
                            $arraySemaine[CalculerChargeService::computeNumeroSemaine($i, $numeroSemaine)][]
                                = array("[$titreModule] $type de $duree min.<br />",
                                $repartition);
                    }

                }
            }
        }
        return $arraySemaine;
    }
}