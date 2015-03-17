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
      $formation = Formation::find($idFormation)
                ->join('pages', 'pages.id', '=', 'semestre.id')
                ->select('semestre.id', 'pages.short_title', 'pages.long_title')->firstOrFail();

      $groupesCoursLibres = GroupeCours::getGroupeCoursLibresByFormation($idFormation);

      $periodes = Calendrier::getPeriodesEnseignement($idFormation);
      //exit(var_dump($periodes));
      $data = array('idFormation' => $idFormation,
          'notifications' => array(),
          'breadcrumb' => array('Scolarel', array("link"=> URL::route('affectation'),"label"=>'Affectation et planification'), $formation->long_title),
          'formation' => $formation,
          'periodes' => $periodes,
          'groupesCoursLibres' => $groupesCoursLibres,
          );

      return View::make('planification')->with($data);
    }

    public function postAjouterPlanification($idFormation)
    {
        $idGroupeCours = Input::get("groupecoursID");

        $clean = Planification::nettoyerPlanificationExistante($idGroupeCours);
        
        if($idGroupeCours != "supprimer") {
            $planification = new Planification();
            $planification->groupecoursID = $idGroupeCours;
            $planification->calendrierID = Input::get('calendrierID');
            $planification->save();
        }

        return "Ok";
    }
}