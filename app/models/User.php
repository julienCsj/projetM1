<?php

class User extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';
    public $timestamps = false;

    public static function getEnseignant() {
        return DB::table('user')
                        ->where('ROLES', '=', "ESPE")
                        ->leftJoin("_statusenseignant", 'login_id', '=', 'login')
                        ->get();
    }

}
