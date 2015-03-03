<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/06/14
 * Time: 09:51
 */

class DashboardController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | IndexController
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    |
    |
    */

    //private $titre = "Proprietaire";

    public function getIndex()
    {
        // $data = array();
        // $utilisateur_id = Session::get('utilisateur')->id_utilisateur;
        // $utilisateur = User::find($utilisateur_id);
        //
        // if($utilisateur->nombre_kilometre_initial == -1) {
             $data = array(
               'notifications' => array(),
                 'breadcrumb' => array('Scolarel', 'Accueil')
               );
        //     $data['premiere_connexion'] = true;
        //     return View::make('back.premiere_connexion')->with($data);
        // } else {
        //     $data['breadcrumb'] = array('Suivi-AAC.fr', 'Tableau de bord');
        //     $data['premiere_connexion'] = false;
            return View::make('dashboard')->with($data);
    }
}
