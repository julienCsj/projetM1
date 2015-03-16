<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';
    protected  $primaryKey = 'LOGIN';
    protected  $timestamp = false;
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('PASSWORD');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function isEnseignant() {
        return Session::get("user")["isEnseignant"] == true;
    }

    public function isResponsable() {
        return Session::get("user")["isEnseignant"] == true && Session::get("user")["isResponsable"] == true;
    }

}
