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

        $conf =  Configuration::where('id', 1)->first();
        $conf->annee = $annee;
        $conf->save();

        return Redirect::route('config');
    }
}