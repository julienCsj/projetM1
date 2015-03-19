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
        return DB::select(DB::raw(''
            . 'select _groupecours.id, _groupecours.formationID, _groupecours.moduleID, pages.short_title, _cours.type , _cours.duree, module.groupe_cm, module.groupe_td, module.groupe_tp '
            . 'from _groupecours, pages, _cours, _groupecours_cours, module '
            . 'where _groupecours.formationID = "'.$idFormation.'" '
            . 'and pages.id = _groupecours.moduleID '
            . 'and _groupecours_cours.groupecoursID = _groupecours.id '
            . 'and _cours.id = _groupecours_cours.coursID '
            . 'and module.id = _groupecours.moduleID '
            . 'ORDER BY _cours.type ASC'));
    }

    public static function getGroupeCoursLibresByFormation($idFormation) {
        return DB::select(DB::raw(''
            . 'select gc.id, gc.libelle, gc.formationID, gc.moduleID, (select count(*) from _groupecours_cours gcc where gcc.groupecoursID = gc.id) as nbcours '
            . 'from _groupecours gc '
            . 'where gc.formationID = "'.$idFormation.'" '
            . 'and gc.id not in(select groupecoursID from _planification) '
            . ''));
    }

    public static function getGroupesCoursByPeriode($idCalendrier) {
        return DB::select(DB::raw(''
            . 'select gc.id, gc.libelle, (select count(*) from _groupecours_cours gcc where gcc.groupecoursID = gc.id) as nbcours '
            . 'from _groupecours gc, _calendrier, _planification '
            . 'where _calendrier.id = _planification.calendrierID '
            . 'and _planification.groupecoursID = gc.id '
            . 'and _calendrier.id = "'.$idCalendrier.'" '
            . ''));
    }

}