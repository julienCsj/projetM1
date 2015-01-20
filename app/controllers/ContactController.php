<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 16/06/14
 * Time: 19:01
 */

class ContactController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | ExporterController
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    |
    |
    |
    */


    public function getFormulaire() {
        $data['breadcrumb'] = array('Suivi-AAC.fr', 'Formulaire de contact');
        return View::make('back.contact.formulaire')->with($data);
    }

}
