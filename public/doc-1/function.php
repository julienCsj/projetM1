<?php

function event($type,$params,$user,$date=false){
	if(!$date) $date = time();
	if(!file_exists(EVENT_FILE)) touch(EVENT_FILE);
	$events = json_decode(file_get_contents(EVENT_FILE));
	$events = $events ==null?array():$events;
	
	$event = (object) array();
	$event->type = $type;
	
	switch($event->type){
		case 'UPDATE_FILE':
			$event->user = $user;
			$event->date = date('d/m/Y H:i:s',$date);
			$event->page = $params['page'];
			$event->link = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "").$params['page'];
		break;
		default:
		break;
	}
	array_unshift($events,$event);
	
	file_put_contents(EVENT_FILE, json_encode($events));
}

function getEvents($filter=false){
	if(!file_exists(EVENT_FILE)) touch(EVENT_FILE);
	$events = file_get_contents(EVENT_FILE);
	$events = $events == ''? array() :json_decode(file_get_contents(EVENT_FILE));
	
	$return = array();
	
	if($filter!=false){
		$key = array_keys($filter);
		$key = $key[0];
		foreach($events as $event){
			if($event->$key == $filter[$key]) $return[] = $event;
		}
	}else{
		$return = $events;
	}
	
	return $return;
}

function getDb($dbFile){
	if(!file_exists($dbFile)) touch($dbFile);
	$db = file_get_contents($dbFile);
	$db = $db == '' ? array() : json_decode(str_replace(array('<?php /* ',' */ ?>'),'',gzinflate($db)),true);
	return $db;
}
function saveDb($dbFile,$dbdata){
	if(!file_exists($dbFile)) touch($dbFile);
	file_put_contents($dbFile,gzdeflate('<?php /* '.json_encode($dbdata).' */ ?>'));
}

function sortVersions($a,$b){
	return $a['version'] < $b['version']?1:-1;
}
?>