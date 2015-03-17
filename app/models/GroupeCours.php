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
            . 'select _groupecours.id, _groupecours.formationID, _groupecours.moduleID, pages.short_title, libelle '
            . 'from _groupecours, pages '
            . 'where _groupecours.formationID = "'.$idFormation.'" '
            . 'and pages.id = _groupecours.moduleID '
            //. 'and _groupecours_cours.groupecoursID = _groupecours.id '
            //. 'and _cours.id = _groupecours_cours.coursID ' , _cours, module, pages, _groupecours_cours
            . ''));
    }

    public static function getGroupeCoursLibresByFormation($idFormation) {
        return DB::select(DB::raw(''
            . 'select _groupecours.id, _groupecours.formationID, _groupecours.moduleID, pages.short_title '
            . 'from _groupecours, pages '
            . 'where _groupecours.formationID = "'.$idFormation.'" '
            . 'and pages.id = _groupecours.moduleID '
            . 'and _groupecours.id not in(select groupecoursID from _planification) '
            . ''));
    }

    public static function getGroupesCoursByPeriode($idCalendrier) {
        return DB::select(DB::raw(''
            . 'select _groupecours.id, pages.short_title '
            . 'from _groupecours, _calendrier, _planification, pages '
            . 'where _calendrier.id = _planification.calendrierID '
            . 'and _planification.groupecoursID = _groupecours.id '
            . 'and pages.id = _groupecours.moduleID '
            . 'and _calendrier.id = "'.$idCalendrier.'" '
            . ''));
    }

}