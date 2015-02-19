<?php

class StatusEnseignant extends Eloquent
{
    protected $table = '_statusenseignant';
    public $timestamps = false;

    public function volumeSpecifique($estFixe) {
        if ($estFixe) {
            $this->taux_horaire_specifique = 1;
        } else {
            $this->taux_horaire_specifique = 0;
        }
    }
}