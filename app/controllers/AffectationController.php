<?php
class AffectationController extends BaseController {

    public function getAffectation()
    {
        $data = array(
          'lesFormations' => Formation::all(),
             'notifications' => array(),
             'breadcrumb' => array('Scolarel', 'Affectation')
          );

        return View::make('affectation_choix_formation')->with($data);
    }

    public function getAffectationFormation($idFormation)
    {
      $formation = Formation::find($idFormation)
                ->join('pages', 'pages.id', '=', 'semestre.id')
                ->select('semestre.id', 'pages.short_title', 'pages.long_title')->firstOrFail();

      $groupesCours = GroupeCours::getGroupeCoursByFormation($idFormation);

      //$modules = Formation::getGroupeCoursByFormation($idFormation);

      $data = array('idFormation' => $idFormation,
          'notifications' => array(),
          'breadcrumb' => array('Scolarel', array("link"=> URL::route('affectation'),"label"=>'Affectation et planification'), $formation->long_title),
          'formation' => $formation,
          'groupesCours' => $groupesCours,
          'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());

      return View::make('affectation')->with($data);
    }

    public function ajouterGroupeCours()
    {

    }

    public function supprimerGroupeCours()
    {
      
    }
    
    // A chaque professeur ont associe une source de financement

}