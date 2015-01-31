<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Formation extends Eloquent {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'semestre';
        //protected $fillable = array('libelle', 'montant');
        public $timestamps = false;
        
        public $lesUE;
        
        
        /* 
         * Redéfinition de la méthode all de Eloquent.
         * La base de données n'etant pas normalisé, il est impossible ici
         * d'utiliser Eloquent de maniere conventionnelle.
         */
        public static function all($column = null) {
           return DB::table('semestre')
            ->join('pages', 'pages.id', '=', 'semestre.id')
            ->select('semestre.id', 'pages.short_title', 'pages.long_title')
            ->get();
        }
        
        public static function getFormationUeModule() {
            $lesFormations = (array) Formation::all();       
            //exit(var_dump($lesFormations));
            
            foreach ($lesFormations as $f) {
                $f->lesUE = UE::getUeByFormation($f->id);
                foreach ($f->lesUE as $ue) {
                    $ue->lesModules = Module::getModuleByUE($ue->id);
                }
            }
            return $lesFormations;
        }
}

