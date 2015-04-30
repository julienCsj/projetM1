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

    // La liste des comptes enseignant qui quand ils se connectent ont le privilege d'être responsable formation
    public static $listeResponsable = array("olivier.catteau", "erwan.callarec", "sylvie.cara", "corinne.lasbouygues");

    public function postFormulaireConnexion() {
        $login = Input::get("login");
        $password = Input::get("password");

        $enseignant =  Enseignant::where('login', '=', $login)->first();
        $user =  User::where('login', '=', $login)->first();
        //exit(var_dump($user));
        if(!empty($user)) {
            if(md5($password) == $user->PASSWORD) {
                if (!empty($enseignant)) {
                    if (in_array($enseignant->LOGIN, IdentificationController::$listeResponsable)) {
                        $user->isResponsable = true;
                    } else {
                        $user->isResponsable = false;
                    }
                    $user->isEnseignant = true;
                    $to = 'dashboard';
                } else {
                    $to = "etudiant";
                    $user->isEnseignant = false;
                    $user->isResponsable = false;
                }
                Auth::login($user);
                Session::put('user', $user);
                return Redirect::to($to)->with( array(
                    'notifications' => array(
                        array(
                            'type' => 'success',
                            'titre' => 'Bonjour '.$user->LASTNAME.' '.$user->FIRSTNAME,
                            'message' => 'La connexion a réussie'
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