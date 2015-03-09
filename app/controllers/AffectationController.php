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
        /*$data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'affectation',
                   'message' => 'Bienvenue sur Scolarel<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('Scolarel', 'Affectation')
               );
        return View::make('affectation')->with($data);*/

        $formation = Formation::find($idFormation)
                ->join('pages', 'pages.id', '=', 'semestre.id')
                ->select('semestre.id', 'pages.short_title', 'pages.long_title')->firstOrFail();
        $data = array('idFormation' => $idFormation,
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', array("link"=> URL::route('calendrier'),"label"=>'Calendriers'), $formation->long_title),
            'formation' => $formation,
            'calendrier' => Calendrier::where('idFormation', '=', $idFormation)->get());

        return View::make('affectation')->with($data);
    }
    
    // A chaque professeur ont associe une source de financement

}