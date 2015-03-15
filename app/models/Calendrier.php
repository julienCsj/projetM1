<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Calendrier extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '_calendrier';
    //protected $fillable = array('libelle', 'montant');
    public $timestamps = false;


    public static function getPeriodesEnseignement($idFormation) {
        $lesPeriodes = Calendrier::where('idFormation', '=', $idFormation)->where('type', '=', 'enseignement')->get();
        return PeriodeToSemaineService::extractWeeks($lesPeriodes);
    }
}