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
               'notifications' => array(
                 array(
                   'type' => 'success',
                   'titre' => 'Félicitations vous êtes inscrit !',
                   'message' => 'Bienvenue sur Suivi-AAC.fr<br/>Vous pouvez maintennant vous connecter'
                 )),
                 'breadcrumb' => array('Suivi-AAC.fr', 'Tableau de bord', 'Première connexion')
               );
        //     $data['premiere_connexion'] = true;
        //     return View::make('back.premiere_connexion')->with($data);
        // } else {
        //     $data['breadcrumb'] = array('Suivi-AAC.fr', 'Tableau de bord');
        //     $data['premiere_connexion'] = false;
            return View::make('back.dashboard')->with($data);
    }

    public function postPremiereInscription() {
        $utilisateur = User::find(Session::get('utilisateur')->id_utilisateur);

        $nbKilometre = Input::get('km');
        if($nbKilometre != "") {
            $utilisateur->nombre_kilometre_initial = $nbKilometre;
        } else {
            $utilisateur->nombre_kilometre_initial = 0;
        }

        $utilisateur->journal_active = Input::get('journal');
        $utilisateur->nom = Input::get('nom');
        $utilisateur->prenom = Input::get('prenom');
        $utilisateur->save();

        $adresse = new Adresse();
        $adresse->utilisateur_id = $utilisateur->id_utilisateur;
        $adresse->nom = "Domicile";
        $adresse->lat = Input::get('lat');
        $adresse->lon = Input::get('lng');
        $adresse->departement = Input::get('departement');
        $adresse->region = Input::get('region');
        $adresse->ville = Input::get('ville');
        $adresse->code_postal = Input::get('code_postal');
        $adresse->save();

        return Redirect::action('DashboardController@getIndex');

    }

}
