<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GroupeCours extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '_groupecours';
    //protected $fillable = array('libelle', 'montant');

    public $timestamps = false;

    public static function getGroupeCoursByFormation($idFormation) {
        return DB::table('_groupecours')
            ->where('_groupecours.id', '=', $idFormation)
            ->select('*')
            ->get();
    }

}