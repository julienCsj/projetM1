<?php
class AffectationController extends BaseController {

    public function getAffectation()
    {
        $data = array(
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'affectation',
                   'message' => 'Bienvenue sur Scolarel<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('Scolarel', 'affectation')
               );
        return View::make('affectation')->with($data);
    }
    
    // A chaque professeur ont associe une source de financement

}