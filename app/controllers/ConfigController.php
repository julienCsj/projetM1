<?php
class ConfigController extends BaseController {
    public function getConfig() {
        $data = array(
            'breadcrumb' => array("Scolarel", "Configuration de l'application")
        );
        return View::make('config')->with($data);
    }
}