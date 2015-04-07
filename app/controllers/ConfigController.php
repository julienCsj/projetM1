<?php
class ConfigController extends BaseController {
    public function getConfig() {
        $data = array(
            'breadcrumb' => array("Scolarel", "Configuration de l'application"),
            'config' => Configuration::where('id', 1)->first()
    );

        return View::make('config')->with($data);
    }


    public function postConfig() {
        $annee = Input::get("annee");
        $rentree = Input::get("dateRentree");
        $fin = Input::get('dateFin');

        $valeurCMEnHService = Input::get('valeurCMEnHService');
        $valeurTDEnHService = Input::get('valeurTDEnHService');
        $valeurTPEnHService = Input::get('valeurTPEnHService');
        $valeurCMEnHServiceHCC = Input::get('valeurCMEnHServiceHCC');
        $valeurTDEnHServiceHCC = Input::get('valeurTDEnHServiceHCC');
        $valeurTPEnHServiceHCC = Input::get('valeurTPEnHServiceHCC');

        $conf =  Configuration::where('id', 1)->first();
        $conf->annee = $annee;
        $conf->dateRentree = $rentree;
        $conf->dateFin = $fin;
        $conf->valeurCMEnHService = $valeurCMEnHService;
        $conf->valeurTDEnHService = $valeurTDEnHService;
        $conf->valeurTPEnHService = $valeurTPEnHService;
        $conf->valeurCMEnHServiceHCC = $valeurCMEnHServiceHCC;
        $conf->valeurTDEnHServiceHCC = $valeurTDEnHServiceHCC;
        $conf->valeurTPEnHServiceHCC = $valeurTPEnHServiceHCC;
        $conf->save();

        return Redirect::route('config');
    }
}