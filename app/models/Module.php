<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Module extends Eloquent {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'module';
        //protected $fillable = array('libelle', 'montant');
        public $timestamps = false;
        
        
        /* 
         * Redéfinition de la méthode all de Eloquent.
         * La base de données n'etant pas normalisé, il est impossible ici
         * d'utiliser Eloquent de maniere conventionnelle.
         */
        public static function all($column = null) {
           return DB::table('module')
            ->join('pages', 'pages.id', '=', 'module.id')
            ->select('module.id', 'pages.short_title', 'pages.long_title')
            ->get();
        }
        
        public static function getModuleByUE($ue) {
            return DB::select(DB::raw(''
                    . 'select module.id, short_title, long_title '
                    . 'from module, pages, links '
                    . 'where module.id = pages.id '
                    . 'and links.id_src = module.id '
                    . 'and links.id_dst = "'.$ue.'"'));
        }
}
