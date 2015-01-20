<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 16/06/14
 * Time: 22:05
 */

class AdresseController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | AdresseController
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    |
    |
    */


    public function getFormulaire($id = "") {
            $adresses = Adresse::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->get();
            $data['adresses'] = $adresses;
            $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des adresses');
            if($id != "") {
                $data['adresse'] = Adresse::find($id);
            }
            return View::make('back.adresse.formulaire')->with($data);

    }

    public function ajouterAdresse() {
        $utilisateur = User::find(Session::get('utilisateur')->id_utilisateur);

        $id = Input::get('id');
        if(empty($id)) {
            $adresse = new Adresse();
            $data['notifications'] = array(
                array(
                    'type' => 'success',
                    'titre' => 'Adresse ajoutée',
                    'message' => ''
                )
            );
        } else {

            $adresse = Adresse::find($id);
            $data['notifications'] = array(
                array(
                    'type' => 'success',
                    'titre' => 'Adresse modifiée',
                    'message' => ''
                )
            );
        }

        $adresse->utilisateur_id = $utilisateur->id_utilisateur;
        $adresse->adresse = Input::get('adresse');
        $adresse->nom = Input::get('nom');
        $adresse->lat = Input::get('lat');
        $adresse->lon = Input::get('lng');
        $adresse->departement = Input::get('departement');
        $adresse->region = Input::get('region');
        $adresse->ville = Input::get('ville');
        $adresse->code_postal = Input::get('code_postal');
        $adresse->save();

        $adresses = Adresse::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->get();
        $data['adresses'] = $adresses;
        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des adresses');
        return View::make('back.adresse.formulaire')->with($data);

    }

    public function supprimer($id) {
        Adresse::find($id)->delete();

        $adresses = Adresse::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->get();
        $data['adresses'] = $adresses;
        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des adresses');
        $data['notifications'] = array(
            array(
                'type' => 'success',
                'titre' => 'Adresse suprimée',
                'message' => ''
            )
        );
        return View::make('back.adresse.formulaire')->with($data);
    }

}
