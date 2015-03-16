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

      $modules = Module::getModulesByFormation($idFormation);

      $data = array('idFormation' => $idFormation,
          'notifications' => array(),
          'breadcrumb' => array('Scolarel', array("link"=> URL::route('affectation'),"label"=>'Affectation et planification'), $formation->long_title),
          'formation' => $formation,
          'modules' => $modules,
          'groupesCours' => $groupesCours,
          'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());
      //exit(var_dump($groupesCours));
      return View::make('affectation')->with($data);
    }

    public function ajouterGroupeCours()
    {
      $idFormation = Input::get('formation');
      $groupeCours = new GroupeCours();
      $groupeCours->moduleID = Input::get('module');
      $groupeCours->formationID = $idFormation;
      $groupeCours->save();
      return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation));
    }

    public function supprimerGroupeCours($idGroupeCours)
    {
      $groupeCours = GroupeCours::find($idGroupeCours);
      $idFormation = $groupeCours->formationID;
      $groupeCours->delete();
      return Redirect::route('affectation.affectationFormation', array('idFormation' => $idFormation));
    }
    
    // A chaque professeur ont associe une source de financement

}