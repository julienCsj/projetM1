<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 15/06/14
 * Time: 10:50
 */

class ExporterController extends BaseController {

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


    public function getFormulaireExporter() {
        return View::make('back.exporter.formulaire');
    }

}
