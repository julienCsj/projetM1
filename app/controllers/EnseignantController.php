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
        $users = User::getEnseignant();
        $data = array(
            'notifications' => array(),
            'breadcrumb' => array('#ApplicationJaneDoe', 'Les enseignants'),
            'enseignant' => $users,
            'typeStatus' => $typeStatus
        );
        return View::make('enseignant')->with($data);
    }

}