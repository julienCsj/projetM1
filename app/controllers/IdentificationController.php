<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 16/02/2015
 * Time: 11:45
 */


class IdentificationController extends BaseController {

    public function getFormulaireConnexion() {
        return View::make('connexion');
    }

    public function postFormulaireConnexion() {
        $login = Input::get("login");
        $password = Input::get("password");

        $user =  User::where('login', '=', $login)->first();
        //exit(var_dump($user));
        if(!empty($user)) {
            if(md5($password) == $user->PASSWORD) {
                Auth::login($user);
                Session::put('user', $user);
                return Redirect::to('dashboard')->with( array(
                    'notifications' => array(
                        array(
                            'type' => 'success',
                            'titre' => 'Félicitations vous êtes inscrit !',
                            'message' => 'Bienvenue sur Scolarel '.$user->LASTNAME.' '.$user->FIRSTNAME.'.'
                        )),
                    'breadcrumb' => array('Scolarel', 'Accueil')
                ));
            } else {
                return View::make('connexion')->with(
                    array('login' => $login,
                          'alerts' => array(
                                array('type' => 'error', 'message' => 'Mot de passe incorrect ...'))));
            }
        } else {
            return View::make('connexion')->with(array(
                'alerts' => array(
                    array('type' => 'error', 'message' => 'Ce compte n\'existe pas ...'))));
        }

    }

    public function deconnexion() {
        Session::flush();
        Auth::logout();
        return Redirect::to('/');
    }
}