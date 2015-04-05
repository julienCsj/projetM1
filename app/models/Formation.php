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
    public $lesGroupes;
    public $nbGroupe;
    
    
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

    public static function getFormationSimple($id) {
        return DB::table('semestre')
            ->where('semestre.id', '=', $id)
            ->join('pages', 'pages.id', '=', 'semestre.id')
            ->select('semestre.id', 'pages.short_title', 'pages.long_title')
            ->get()[0];
    }

    public static function getFormationAvecGroupes($id) {
        $formation = Formation::getFormationSimple($id);

        $groupestd = DB::select(DB::raw(''
            . 'select count(*) as res '
            . 'from _groupe '
            . 'where semestre_id = "'.$id.'"'));

        $groupestp = DB::select(DB::raw(''
            . 'select sum(sous_groupe) as res '
            . 'from _groupe '
            . 'where semestre_id = "'.$id.'"'));

        if($groupestp[0]->res == NULL) {
            $groupestp[0]->res = 0;
        }

        $formation->nbgroupestd = $groupestd[0]->res;
        $formation->nbgroupestp = $groupestp[0]->res;

        return $formation;
    }
    
    public static function getFormationUeModule() {
        $lesFormations = (array) Formation::all();
        foreach ($lesFormations as $f) {
            $f->lesUE = UE::getUeByFormation($f->id);
            foreach ($f->lesUE as $ue) {
                $listeModule = Module::getModuleByUE($ue->id);
                foreach($listeModule as $module) {
                    $ue->lesModules[] = Module::getModuleWithData($module->id);
                }
            }
        }
        return $lesFormations;
    }
}

