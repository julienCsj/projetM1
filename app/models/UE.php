<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UE extends EloqUEnt {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'UE';
    //protected $fillable = array('libelle', 'montant');
    public $timestamps = false;
    public $lesModules = array();

    /*
     * Redéfinition de la méthode all de EloqUEnt.
     * La base de données n'etant pas normalisé, il est impossible ici
     * d'utiliser EloqUEnt de maniere conventionnelle.
     */

    public static function all($column = null) {
        return DB::table('UE')
                        ->join('pages', 'pages.id', '=', 'UE.id')
                        ->select('UE.id', 'short_title', 'long_title')
                        ->get();
    }

    public static function getUeSimple($id) {
        return DB::table('UE')
            ->where('UE.id', '=', $id)
            ->join('pages', 'pages.id', '=', 'UE.id')
            ->select('UE.id', 'pages.short_title', 'pages.long_title')
            ->get()[0];
    }

    /*
     * TO DO : Ecrire la reqUEte avec le qUEry builder
     */
    public static function getUeByFormation($formation) {
        return DB::select(DB::raw(''
                        . 'select UE.id, short_title, long_title '
                        . 'from UE, pages, links '
                        . 'where UE.id = pages.id '
                        . 'and links.id_src = UE.id '
                        . 'and links.id_dst = "' . $formation . '"'
                        . ''));  
    }

}
