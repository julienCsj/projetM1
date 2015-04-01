<?php

class Voeux extends Eloquent
{
    protected $table = '_enseignant_voeux';
    public $timestamps = false;

    public static function getVoeux($enseignant_id) {
        $query = DB::table('_enseignant_voeux')
        	->where('enseignant_id', '=', $enseignant_id)
            ->get();
        $result = array();
        for ($i=0; $i < 6; $i++) { 
			$result[$i] = array();
        	for ($j=0; $j < 9; $j++) {
        		$found = false;
        		foreach ($query as $key => $value) {
        			if ($value->jour == $i && $value->creneau == $j) {
        				$result[$i][$j] = 0;
        				$found = true;
        				break;
        			}
        		} 
        		if (!$found) {
    				$result[$i][$j] = 1;
        		}
        	}
        }
        return $result;
    }

    public static function supprimerVoeux($enseignant_id, $_jour, $_creneau) {
    	$statusEnseignant = 
    	Voeux::where('enseignant_id', '=', $enseignant_id)
            ->where('jour', '=', $_jour)
            ->where('creneau', '=', $_creneau)
            ->first();

    	$statusEnseignant->delete();
    }
}