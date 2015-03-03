<?php

class EnseignantController extends BaseController
{
    public function getEnseignants()
    {
        $status = TypeStatusEnseignant::get();
        $typeStatus = array();
        foreach($status as $k => $v) {
            $typeStatus[$v["id"]] = $v->toArray();
        }
        $users = Enseignant::getEnseignantAndStatus();
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('Scolarel', 'Gestion des enseignants'),
            'enseignant' => $users,
            'typeStatus' => $typeStatus
        );
        return View::make('enseignant')->with($data);
    }

}