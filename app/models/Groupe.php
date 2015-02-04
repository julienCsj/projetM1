<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Groupe extends Eloquent {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = '_groupe';
    //protected $fillable = array('libelle', 'montant');
    public $timestamps = false;
    
    public static function getGroupeModule() {
        $lesFormations = (array) Formation::all();       

        foreach ($lesFormations as $f) {
            $f->lesGroupes = Groupe::getGroupesByFormation($f->id);
        }
        return $lesFormations;
    }

    public static function getGroupesByFormation($id) {
        return DB::select(DB::raw(''
                    . 'select id, nom '
                    . 'from _groupe '
                    . 'where _groupe.formation_id = "'.$id.'"'
                    . ''));  
    }
}
