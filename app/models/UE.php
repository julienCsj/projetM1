<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UE extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ue';
    //protected $fillable = array('libelle', 'montant');
    public $timestamps = false;
    public $lesModules;

    /*
     * Redéfinition de la méthode all de Eloquent.
     * La base de données n'etant pas normalisé, il est impossible ici
     * d'utiliser Eloquent de maniere conventionnelle.
     */

    public static function all($column = null) {
        return DB::table('ue')
                        ->join('pages', 'pages.id', '=', 'ue.id')
                        ->select('ue.id', 'short_title', 'long_title')
                        ->get();
    }

    
    /*
     * TO DO : Ecrire la requete avec le query builder
     */
    public static function getUeByFormation($formation) {
        return DB::select(DB::raw(''
                        . 'select ue.id, short_title, long_title '
                        . 'from ue, pages, links '
                        . 'where ue.id = pages.id '
                        . 'and links.id_src = ue.id '
                        . 'and links.id_dst = "' . $formation . '"'
                        . ''));  
    }

}
