<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 15/06/14
 * Time: 10:50
 */

class TrajetController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | TrajetController
    |--------------------------------------------------------------------------
    |
    | 
    | 
    | 
    |
    |	
    |
    */

    /*
     * Liste
     */
    public function getListe() {
        $lesTrajets = Trajet::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->orderBy('id_trajet', 'desc')->paginate(5);
        foreach($lesTrajets as $t) {
            $t['waypts'] = Waypoint::where('trajet_id', '=', $t->id_trajet)->orderBy('ordre')->get();
        }

        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des trajets', 'Ajouter un trajet');
        $data['lesTrajets'] = $lesTrajets;
        return View::make('back.trajet.liste')->with($data);
    }


    public function getAjouter() {
        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des trajets', 'Ajouter un trajet');
        $adresses = Adresse::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->get();
        $data['adresses'] = $adresses;
        return View::make('back.trajet.ajouter')->with($data);
    }




    public function ajouter() {

        $trajet = new Trajet();
        // Determiner la méthode d'ajout
        $methode = Input::get('methode');
        switch($methode) {
            case 'google' :
                $depart = Input::get('depart_google');
                $arrivee = Input::get('arrivee_google');
            break;

            case 'adresse' :
                $depart = Input::get('depart_adresse');
                $arrivee = Input::get('arrivee_adresse');
            break;

            case 'perso' :
                $depart = Input::get('depart_perso');
                $arrivee = Input::get('arrivee_perso');
                break;

        }

        // convertir la durée en minute
        $dureeheure = Input::get('duree');
        $chaine =  explode (':', $dureeheure);
        $dureeMinutes = intval($chaine[0]) * 60 + intval($chaine[1]);

        $myDateTime = DateTime::createFromFormat('d/m/Y', Input::get('date'));
        $newDate = $myDateTime->format('Y-m-d');


        $trajet->meteo_ensoleille = Input::get('meteo_ensoleille') == 1 ? '1' : '0';
        $trajet->meteo_pluvieux = Input::get('meteo_pluvieux') == 1 ? '1' : '0';
        $trajet->meteo_brumeux = Input::get('meteo_brumeux') == 1 ? '1' : '0';
        $trajet->meteo_neige = Input::get('meteo_neige') == 1 ? '1' : '0';
        $trajet->jour = Input::get('meteo_jour') == 1 ? '1' : '0';
        $trajet->nuit = Input::get('meteo_nuit') == 1 ? '1' : '0';
        $trajet->type_agglo = Input::get('type_ville') == 1 ? '1' : '0';
        $trajet->type_campagne = Input::get('type_campagne') == 1 ? '1' : '0';
        $trajet->type_montagne = Input::get('type_montagne') == 1 ? '1' : '0';
        $trajet->type_gd_axe = Input::get('type_gd_axe') == 1 ? '1' : '0';
        $trajet->remarque = Input::get('remarque');
        $trajet->depart = $depart;
        $trajet->arrivee = $arrivee;
        $trajet->lat_depart = Input::get('depart_lat');
        $trajet->lon_depart = Input::get('depart_lon');
        $trajet->lat_arrivee = Input::get('arrive_lat');
        $trajet->lon_arrivee = Input::get('arrive_lon');
        $trajet->trafic_dense = Input::get('trafic_dense') == 1 ? '1' : '0';
        $trajet->trafic_fluide = Input::get('trafic_fluide') == 1 ? '1' : '0';
        $trajet->trafic_bouchon = Input::get('trafic_bouchon') == 1 ? '1' : '0';
        $trajet->etat_forme = Input::get('etat_forme') == 1 ? '1' : '0';
        $trajet->etat_fatigue = Input::get('etat_fatigue') == 1 ? '1' : '0';
        $trajet->date = $newDate;
        $trajet->duree = $dureeMinutes;
        $trajet->distance = Input::get('distance') != '' ? Input::get('distance') : 0;
        $trajet->methode = $methode;
        $trajet->utilisateur_id = Session::get('utilisateur')->id_utilisateur;
        $trajet->save();

        $nb_waypts = Input::get('nb_waypts');

        for($i=0; $i<$nb_waypts; $i++) {
            $waypoint = new Waypoint();
            $waypoint-> trajet_id = $trajet->id_trajet;
            $waypoint-> ordre = $i+1;
            $waypoint->lat = Input::get('lat'.$i);
            $waypoint->lon = Input::get('lon'.$i);
            $waypoint->save();
        }

        return Redirect::action('TrajetController@getListe');
    }

    public function getModifier($idTrajet) {
        $trajet = Trajet::find($idTrajet);
        $lesWaypoints = Waypoint::where('trajet_id', '=', $idTrajet)->orderBy('ordre')->get();
        $data = array('trajet' => $trajet,
                       'lesWaypoints' => $lesWaypoints);

        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Gestion des trajets', 'Modifier un trajet');
        $adresses = Adresse::where('utilisateur_id', '=', Session::get('utilisateur')->id_utilisateur)->get();
        $data['adresses'] = $adresses;


        return View::make('back.trajet.modifier')->with($data);
    }


    public function postModifier() {
        $idTrajet = Input::get('id_trajet');
        $trajet = Trajet::find($idTrajet);

        // Determiner la méthode d'ajout
        $methode = Input::get('methode');
        switch($methode) {
            case 'google' :
                $depart = Input::get('depart_google');
                $arrivee = Input::get('arrivee_google');
                break;

            case 'adresse' :
                $depart = Input::get('depart_adresse');
                $arrivee = Input::get('arrivee_adresse');
                break;

            case 'perso' :
                $depart = Input::get('depart_perso');
                $arrivee = Input::get('arrivee_perso');
                break;

        }

        // convertir la durée en minute
        $dureeheure = Input::get('duree');
        $chaine =  explode (':', $dureeheure);
        $dureeMinutes = intval($chaine[0]) * 60 + intval($chaine[1]);

        $myDateTime = DateTime::createFromFormat('d/m/Y', Input::get('date'));
        $newDate = $myDateTime->format('Y-m-d');


        $trajet->meteo_ensoleille = Input::get('meteo_ensoleille') == 1 ? '1' : '0';
        $trajet->meteo_pluvieux = Input::get('meteo_pluvieux') == 1 ? '1' : '0';
        $trajet->meteo_brumeux = Input::get('meteo_brumeux') == 1 ? '1' : '0';
        $trajet->meteo_neige = Input::get('meteo_neige') == 1 ? '1' : '0';
        $trajet->jour = Input::get('meteo_jour') == 1 ? '1' : '0';
        $trajet->nuit = Input::get('meteo_nuit') == 1 ? '1' : '0';
        $trajet->type_agglo = Input::get('type_ville') == 1 ? '1' : '0';
        $trajet->type_campagne = Input::get('type_campagne') == 1 ? '1' : '0';
        $trajet->type_montagne = Input::get('type_montagne') == 1 ? '1' : '0';
        $trajet->type_gd_axe = Input::get('type_gd_axe') == 1 ? '1' : '0';
        $trajet->remarque = Input::get('remarque');
        $trajet->depart = $depart;
        $trajet->arrivee = $arrivee;

        $trajet->lat_depart = Input::get('depart_lat');
        $trajet->lon_depart = Input::get('depart_lon');
        $trajet->lat_arrivee = Input::get('arrive_lat');
        $trajet->lon_arrivee = Input::get('arrive_lon');

        $trajet->trafic_dense = Input::get('trafic_dense') == 1 ? '1' : '0';
        $trajet->trafic_fluide = Input::get('trafic_fluide') == 1 ? '1' : '0';
        $trajet->trafic_bouchon = Input::get('trafic_bouchon') == 1 ? '1' : '0';
        $trajet->etat_forme = Input::get('etat_forme') == 1 ? '1' : '0';
        $trajet->etat_fatigue = Input::get('etat_fatigue') == 1 ? '1' : '0';
        $trajet->date = $newDate;
        $trajet->duree = $dureeMinutes;
        $trajet->distance = Input::get('distance') != '' ? Input::get('distance') : 0;
        $trajet->methode = $methode;
        $trajet->utilisateur_id = Session::get('utilisateur')->id_utilisateur;
        $trajet->save();

        Waypoint::where('trajet_id', '=', $idTrajet)->delete();

        $nb_waypts = Input::get('nb_waypts');
        for($i=0; $i<$nb_waypts; $i++) {
            $waypoint = new Waypoint();
            $waypoint-> trajet_id = $trajet->id_trajet;
            $waypoint-> ordre = $i+1;
            $waypoint->lat = Input::get('lat'.$i);
            $waypoint->lon = Input::get('lon'.$i);
            $waypoint->save();
        }

        return Redirect::action('TrajetController@getListe');
    }

    public function supprimer($idTrajet) {

        Trajet::find($idTrajet)->delete();
        Waypoint::where('trajet_id', '=', $idTrajet)->delete();
        return Redirect::action('TrajetController@getListe');
    }
}
