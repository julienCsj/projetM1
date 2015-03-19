<?php
class ModuleEnseignant extends Eloquent {

    public $timestamps = false;
    protected $table = '_module_enseignant';
    public static function getEnseignants($idModule) {
    	return DB::select(DB::raw(''
            . 'select LASTNAME, FIRSTNAME,enseignant_id '
            . 'from _module_enseignant, user '
            . 'where module_id = "'.$idModule.'" '
            . 'and _module_enseignant.enseignant_id = user.login'));
    }
}