<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 07/02/15
 * Time: 16:11
 */

class StatusEnseignantController extends BaseController {
    public function postModifierStatus()
    {
        $_choix = intval(Input::get('choix'));
        $_status = Input::get('status');
        $_volumeHoraire = Input::get('volumeHoraire');
        $_idEnseignant = Input::get('idEnseignant');
        if ($_idEnseignant != -1) {
            $statusEnseignant = StatusEnseignant::where('login_id', '=', $_idEnseignant)->first();
            if ($statusEnseignant == NULL) {
                $statusEnseignant = new StatusEnseignant();
                $statusEnseignant->login_id = $_idEnseignant;
            }
        }
        switch($_choix) {
            case 0:
                // Changement de status pour le professeur
                $statusEnseignant->volumeSpecifique(false);
                $statusEnseignant->volume_horaire = 0;
                $statusEnseignant->typestatus_id = $_status;
                $statusEnseignant->save();
                break;
            case 1:
                // Ou c'est un volume horaire fixe
                $statusEnseignant->volumeSpecifique(true);
                $statusEnseignant->volume_horaire = $_volumeHoraire;
                $statusEnseignant->typestatus_id = 1;
                $statusEnseignant->save();
                break;
        }
        return "Ok";
    }


}