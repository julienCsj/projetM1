<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GroupeCoursEnseignantModule extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '_groupecours_module_enseignant';

    public $timestamps = false;

    public static function get($idModule) {
        return DB::select(DB::raw(''
            . 'select * '
            . 'from _groupecours_module_enseignant '
            . 'where module_id = "'.$idModule.'" '
            . 'ORDER BY id_groupe ASC'));
    }
}