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

        $conf =  Configuration::where('id', 1)->first();
        $conf->annee = $annee;
        $conf->dateRentree = $rentree;
        $conf->dateFin = $fin;
        $conf->save();

        return Redirect::route('config');
    }
}