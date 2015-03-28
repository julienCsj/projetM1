<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 28/03/15
 * Time: 15:12
 */


class Configuration extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '_config';
    public $timestamps = false;
}
