<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 07/04/15
 * Time: 13:57
 */

class EmploiDuTempsController extends BaseController {
    public function getEmploiDuTemps($idFormation = -1) {
        $data = array(
            'breadcrumb' => array("Scolarel", "Configuration de l'application"),
            'lesFormations' => Formation::all(),
            'idFormation' => $idFormation,
        );

        if($idFormation != -1) {
            //exit(var_dump(CalculerChargeService::genererEmploiDuTempsFormation($idFormation)));
            $data["service"] = CalculerChargeService::genererEmploiDuTempsFormation($idFormation);
        }

        return View::make('emploi_du_temps')->with($data);
    }
}