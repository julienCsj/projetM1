<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Financement extends Eloquent {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = '_financement';
        protected $fillable = array('libelle', 'montant');
        public $timestamps = false;
    public static function getFinancementParModule($idModule) {
    	return DB::table('_financement')
        ->select('_financement.libelle', '_financement.id')
        ->join('_module_financement', '_module_financement.financement_id', '=', '_financement.id')
        ->where("_module_financement.module_id","=", $idModule)
        ->get();
    }
}
