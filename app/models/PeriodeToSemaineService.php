<?php
class PeriodeToSemaineService {

	public static function extractWeeks($periodes) {
		$result = array();
		foreach ($periodes as $k => $v) {
			$result[] = PeriodeToSemaineService::extractWeeksFromPeriod($v);
		}
		return $result;
	}

	public static function extractWeeksFromPeriod($v) {
		$jour = array(
			"1" => "lundi",
			"2" => "mardi",
			"3" => "merc",
			"4" => "jeudi",
			"5" => "ven",
			"6" => "sam",
			"7" => "dim"
		);
		$mois = array(
			"1" => "jan",
			"2" => "fév",
			"3" => "mars",
			"4" => "avr",
			"5" => "mai",
			"6" => "juin",
			"7" => "juillet",
			"8" => "août",
			"9" => "sept",
			"10" => "oct",
			"11" => "nov",
			"12" => "déc"
		);
		$result = array();
		$deb = strtotime($v->dateDebut) + 7200;
		$fin = strtotime($v->dateFin) + 7200;
		while ($deb < $fin) {
			$d1 = date("N", $deb);
			$fin_semaine = $deb; 
			switch ($d1) {
				case 1:
					$fin_semaine += 604800; // 7j en sec
					break;
				case 2:
					$fin_semaine += 518400;
					break;
				case 3:
					$fin_semaine += 432000;
					break;
				case 4:
					$fin_semaine += 345600;
					break;
				case 5:
					$fin_semaine += 259200;
					break;
				case 6:
					$fin_semaine += 172800;
					break;	
				case 7:
					$fin_semaine += 86400;
					break;
			}
			if ($fin_semaine < $fin) {
				$fin_result = $fin_semaine-1; // fini avec le dernier jour de la semaine
			} else {
				$fin_result = $fin; // fini avec le dernier jour de la periode
			}
			$result[] = array(
				"deb" => $deb, //1 er jour de la nouvelle periode
				"fin" => $fin_result, // dimanche soir
				"semaine" => date("W", $deb),
				"label" => "Semaine #".date("W", $deb)." du ". $jour[date("N", $deb)]." " . date("d ", $deb) . $mois[date("n", $deb)]. date(" Y", $deb)." au " . $jour[date("N", $fin_result)]." " . date("d ", $fin_result) . $mois[date("n", $fin_result)]
			);
			$deb = $fin_semaine;
		}
		return $result;
	}
}