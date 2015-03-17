<?php

class GenerationFicheController extends BaseController {

    public function getFiche() {
        $data = array(
            'breadcrumb' => array("Scolarel", "Fiche")
        );
        return View::make('fiche')->with($data);
    }
}