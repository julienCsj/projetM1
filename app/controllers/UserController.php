<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/06/14
 * Time: 17:10
 */


class UserController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | UserController
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    |
    |
    */

    private $titre = "Proprietaire";

    public function getIndex()
    {
        return View::make('front.index');
    }

    public function getInscription()
    {
        return View::make('front.inscription');
    }

    public function postConnexion($mail = null, $password = null )
    {
        // Si on est redirigé depuis une inscription, les identifians sont passé en parametres
        // Sinon, il faut les récuprer dans $_POST
        if(empty($mail) && empty($password)) {
            $mail = Input::get('email');
            $password = Input::get('password');
        }

        if(!empty($mail) && !empty($password)) {
            $utilisateur = User::where('email', '=', $mail)->first();
            if(empty($utilisateur)) {
                $data['message'] = "Vos identifiants sont incorrects";
            }
            else
            {
                if($utilisateur->etat == "valide")
                {
                    if(Auth::attempt(array('email' => $mail, 'password' => $password)))
                    {
                        $utilisateur->derniere_connexion = date('Y-m-d H:i');
                        $utilisateur->save();
                        Session::put('utilisateur', $utilisateur);
                        return Redirect::intended('dashboard');

                    }
                    else
                    {
                        $data['message'] = "Vos identifiants sont incorrects";
                    }
                }
                else
                {
                    $data['message'] = "Votre compte a été bloqué par un administrateur";
                }
            }
        }
        else
        {
            $data['message'] = "Veuillez remplir les deux champs";
        }
        return View::make('front.index')->with($data);
    }


    public function postInscription()
    {
        // Récupération des données
        $nom = Input::get('nom');
        $prenom = Input::get('prenom');
        $password = Input::get('password');
        $email = Input::get('email');
        $newsletter = Input::get('newsletter');
        if($newsletter != 1) $newsletter = 0;



        if(!empty($email) && !empty($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(strlen($password) >= 4) {
                    // Est ce que le mail est deja dans la bd ?
                    $utilisateur =  User::where('email', '=', $email)->get();
                    $count = $utilisateur->count();
                    if($count == 0) {
                        // envoyer les informations en base
                        $utilisateur = new User;
                        $utilisateur->nom = $nom;
                        $utilisateur->prenom = $prenom;
                        $utilisateur->email = $email;
                        $utilisateur->password = Hash::make($password);
                        $utilisateur->groupe = "Utilisateurs";
                        $utilisateur->newsletter = $newsletter;
                        $utilisateur->etat = "valide";
                        $utilisateur->date_inscription = date('Y-m-d H:i');
                        $utilisateur->save();

                        $data = array(
                            'notifications' => array(
                                                     array(
                                                            'type' => 'success',
                                                            'titre' => 'Félicitations vous êtes inscrit !',
                                                            'message' => 'Bienvenue sur Suivi-AAC.fr<br/>Vous pouvez maintennant vous connecter'
                                                          )
                                                    ),
                            'email' => $email
                        );

                        return View::make('front.index')-> with($data);
                    }
                    else
                    {
                        $data['message'] = "Cette adresse mail est déjà utilisée par un de nos membre";
                    }
                }
                else
                {
                    $data['message'] = "Le mot de passe doit contenir plus de 4 caracteres";
                }
            }
            else
            {
                $data['message'] = "Votre adresse mail n'est pas valide !";
            }
        }
        else
        {
            $data['message'] = "Il faut remplir tous les champs !";
        }

        return View::make('front.inscription')->with($data);
    }

    public function getProfil()
    {
        return View::make('back.index');
    }

    public function getDeconnexion()
    {
        Session::flush();
        Auth::logout();

        $data = array(
            'notifications' => array(
                array(
                    'type' => 'success',
                    'titre' => 'Déconnexion',
                    'message' => 'Vous êtes bien déconnecté de Suivi-AAC. A bientôt !'
                )
            )
        );

        return View::make('front.index')-> with($data);
    }



}
