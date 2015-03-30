<?php
class User{
	public $login,$rank,$rights=array();

	public function setRank($rank){
		$this->rank = $rank;
		switch($this->rank){
			case 'admin':
				$this->rights = array( 'EDIT_PAGE','EDIT_MENU','DELETE_FILE','UPLOAD_FILE','MANAGE_PAGE_REQUEST','MANAGE_MENU_REQUEST');
			break;
			case 'moderator':
				$this->rights = array( 'EDIT_PAGE','DELETE_FILE','UPLOAD_FILE','MANAGE_REQUEST' );
			break;
			case 'user':
				$this->rights = array( 'SEND_PAGE_REQUEST','SEND_MENU_REQUEST' );
			break;
		}
	}


	
	public function can($right){
		return in_array($right, $this->rights)?true:false;
	}
}
?>