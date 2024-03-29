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
    public $lesFinancements;
    public $nbGroupes;
    public $lesEnseignants;

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

    public static function get($idModule) {
        return DB::table('module')
            ->join('pages', 'pages.id', '=', 'module.id')
            ->where('module.id', '=', $idModule)
            ->select('*')
            ->get();
    }

    public static function supprimerFinancement($idModule) {
        return DB::table('_module_financement')->where('module_id', '=', $idModule)->delete();
    }

    public static function supprimerEnseignant($idModule) {
        return DB::table('_module_enseignant')->where('module_id', '=', $idModule)->delete();
    }

    public static function supprimerUnFinancement($idModule, $idFinancement) {
        return DB::table('_module_financement')->where('module_id', '=', $idModule)->where('financement_id', '=', $idFinancement)->delete();
    }

    public static function supprimerUnEnseignant($idModule, $idEnseignant) {
        return DB::table('_module_enseignant')->where('module_id', '=', $idModule)->where('enseignant_id', '=', $idEnseignant)->delete();
    }

    public static function ajouterFinancement($financement, $idModule) {
        return DB::table('_module_financement')->insert(
            array('module_id' => $idModule,
                  'financement_id' => $financement)
        );
    }

    public static function ajouterEnseignant($enseignant, $idModule) {
        return DB::table('_module_enseignant')->insert(
            array('module_id' => $idModule,
                'enseignant_id' => $enseignant)
        );
    }

    public static function getModuleByUE($ue) {
        return DB::select(DB::raw(''
            . 'select module.id '
            . 'from module, pages, links '
            . 'where module.id = pages.id '
            . 'and links.id_src = module.id '
            . 'and links.id_dst = "'.$ue.'"'));
    }

    public static function getModuleByUEWithTitle($ue) {
        return DB::select(DB::raw(''
            . 'select module.id, pages.short_title '
            . 'from module, pages, links '
            . 'where module.id = pages.id '
            . 'and links.id_src = module.id '
            . 'and links.id_dst = "'.$ue.'"'));
    }

    public static function getModuleWithData($idModule) {
        $module = (array) Module::get($idModule);
        $module = $module[0];

        $module->lesFinancements = DB::select(DB::raw(''
            . 'select _financement.id, _financement.libelle '
            . 'from _financement, _module_financement '
            . 'where _module_financement.module_id = "'.$idModule.'" '
            . 'and _module_financement.financement_id = _financement.id'));

        $module->lesEnseignants = DB::select(DB::raw(''
            . 'select user.login, user.lastname, user.firstname '
            . 'from user, _module_enseignant '
            . 'where _module_enseignant.module_id = "'.$idModule.'" '
            . 'and _module_enseignant.enseignant_id = user.login'));

        return $module;
    }

    public static function getModulesByFormation($idFormation) {
        $lesUEs = (array) UE::getUeByFormation($idFormation);

        $lesModules = array();
        foreach($lesUEs as $ue) {
            array_push($lesModules,Module::getModuleByUeWithTitle($ue->id));
        }
        //exit(var_dump($lesModules));
        return $lesModules;
    }

    public static function getCm($idModule) {
        return null;
    }

    public static function getTd($idModule) {
        return null;
    }

    public static function getTp($idModule) {
        return null;
    }

    public static function getAllCours($idModule) {
        return null;
    }
}