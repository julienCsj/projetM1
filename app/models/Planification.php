<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Planification extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '_planification';
    //protected $fillable = array('libelle', 'montant');

    public $timestamps = false;

    public static function nettoyerPlanificationExistante($idGroupeCours) {
        return DB::table('_planification')->where('groupecoursID', '=', $idGroupeCours)->delete();
    }
    
}