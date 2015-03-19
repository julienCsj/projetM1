<?php

class Enseignant extends Eloquent
{
    protected $table = 'enseignant';
    public $timestamps = false;

    public static function getEnseignantAndStatus() {
        return DB::table('enseignant')
            ->join('user', 'user.login', '=', 'enseignant.login')
            ->leftJoin("_statusenseignant", '_statusenseignant.login_id', '=', 'enseignant.login')
            ->get();
    }

    public static function getEnseignantsWithPageData(){
        return DB::table('enseignant')
            ->join('user', 'user.login', '=', 'enseignant.login')
            ->get();
    }
}