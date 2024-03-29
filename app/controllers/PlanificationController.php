<?php
class PlanificationController extends BaseController {

    public function getPlanification()
    {
        $data = array(
            'lesFormations' => Formation::all(),
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Affectation')
        );

        return View::make('planification_choix_formation')->with($data);
    }

    public function getPlanificationFormation($idFormation)
    {
      $formation = Formation::getFormationSimple($idFormation);

      $groupesCoursLibres = GroupeCours::getGroupeCoursLibresByFormation($idFormation);

      $periodes = Calendrier::getPeriodesEnseignement($idFormation);

      $data = array('idFormation' => $idFormation,
          'notifications' => array(),
          'breadcrumb' => array('Scolarel', array("link"=> URL::route('affectation'),"label"=>'Affectation et planification'), $formation->long_title),
          'formation' => $formation,
          'periodes' => $periodes,
          'groupesCoursLibres' => $groupesCoursLibres,
          );

      return View::make('planification')->with($data);
    }

    public function postAjouterPlanification()
    {
        $idGroupeCours = Input::get('groupecoursID');
        $idCalendrier = Input::get('calendrierID');
        $semaine = Input::get('semaine');

        $clean = Planification::nettoyerPlanificationExistante($idGroupeCours);

        if($idCalendrier != "supprimer") {
            $planification = new Planification();
            $planification->groupecoursID = $idGroupeCours;
            $planification->calendrierID = $idCalendrier;
            $planification->semaine = $semaine;
            $planification->save();
        }
        return "Ok";
    }

    public function postDatesSemaines()
    {
        $idCalendrier = Input::get('calendrierID');

        $periode = Calendrier::find($idCalendrier);

        $result = PeriodeToSemaineService::extractWeeksSimple($periode);

        $i = 0;
        foreach($result['sem'] as $semaine) {
          $data[$i] = $semaine['datedeb'];
          $i++;
        }

        //return json_encode($data);
        echo json_encode($data);
        exit;
    }
}