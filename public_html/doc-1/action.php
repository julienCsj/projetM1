<?php
require_once('common.php');

$jsonResponse = array();
$jsonResponse['success'] = false;

//Actions
switch($action){
	
	case 'viewdiff':
		echo '<pre>';
		$content = stripslashes(file_get_contents(MD_ROOT.$_['page'].MD_EXTENSION));
		$diff_opcodes = file_get_contents($_['version']);
		$from_text = FineDiff::renderToTextFromOpcodes($content, $diff_opcodes);
		$diff_opcodes = FineDiff::getDiffOpcodes($from_text, $content);
		echo FineDiff::renderDiffToHTMLFromOpcodes($from_text, $diff_opcodes).'</pre>';
	break;
	
	case 'edit':

	if($myUser!=false){
		$emptyMessage = ($page==MD_MENU?MD_MENU_DEFAUT_CONTENT:'Le contenu de  **'.$page.'** est vide :p');
		$content = file_exists($pagePath)?file_get_contents($pagePath):$emptyMessage;
		$content = stripslashes($content);
		
		$archives = glob(ARCHIVES_ROOT.$page.'/*');
		if(is_array($archives) && count($archives)>0){
			foreach($archives as $archive){
				list($d,$m,$y,$h,$i,$v,$a) = explode('-',basename($archive));
				$jsonResponse['versions'][] = 
				array('date' => $d.'/'.$m.'/'.$y.' '.$h.'h'.$i,'author' => $a,'version' => $v,'link' => $archive);
			}
			usort($jsonResponse['versions'],'sortVersions');
		}
		if(isset($_['version'])){
			foreach($jsonResponse['versions'] as $version){
				if($version['version']==$_['version']){
					break;
				}else{
					$content = FineDiff::renderToTextFromOpcodes($content, file_get_contents($version['link']));
				}
			}
		}
		
		$jsonResponse['success'] = true;
		$jsonResponse['content'] = $content;
		
		
	}else{
		$jsonResponse['message'] = 'Vous ne pouvez pas editer tant que vous n\'êtes pas connecté.';
	}
		echo json_encode($jsonResponse);
	break;

	case 'save':
		if($myUser!=false){
			$newContent = html_entity_decode($_['content'],ENT_QUOTES,'UTF-8');
			$oldContent = file_exists($pagePath)?file_get_contents($pagePath):'';
			
			if($newContent!=$oldContent){
				$mod = FineDiff::getDiffOpcodes($newContent, $oldContent);
				event('UPDATE_FILE',array('page'=>$page),$myUser->login);
				if(!is_dir(ARCHIVES_ROOT) ) mkdir(ARCHIVES_ROOT);
				$folders = explode('/',$pagePath);
				$p = array_pop($folders);
				$path = MD_ROOT;
				$archives = ARCHIVES_ROOT;
				foreach ($folders as $key => $dir) {
						if($key == 1) {
							$path = $dir;
						} elseif($key != 0) {
							$path .= '/'.$dir;
							$archives .= '/'.$dir;
						}
					if (!is_dir($path)) {
						mkdir($path);
					}
					if (!is_dir($archives)) {
						mkdir($archives);
					}
				}
				file_put_contents($pagePath, $newContent);
				if(!file_exists(ARCHIVES_ROOT.$page)) mkdir(ARCHIVES_ROOT.$page);
				$count = glob(ARCHIVES_ROOT.$page.'/*');
				file_put_contents(ARCHIVES_ROOT.$page.'/'.date('d-m-Y-H-i').'-'.count($count).'-'.$myUser->login,$mod);
			}
			$content = Parsedown::instance()->parse(html_entity_decode($_['content'],ENT_QUOTES,'UTF-8'));
			$jsonResponse['success'] = true;
			$jsonResponse['content'] = stripslashes($content);
		}else{
			$jsonResponse['message'] = 'Vous ne pouvez pas editer tant que vous n\'êtes pas connecté.';
		}
		echo json_encode($jsonResponse);
	break;
	
	case 'login':
		$users = getDb(USER_DB);
		$myUser = false;
		foreach($users as $user){
			if($_['login']==$user['login'] && sha1($_['password'])==$user['password']){
				$myUser = new User();
				$myUser->login = $user['login'];
				$myUser->setRank($user['rank']);
			}
		}
		if($myUser!=false){
			$_SESSION['user'] = serialize($myUser);
			$jsonResponse['success'] = true;
		}else{
			$jsonResponse['message'] = 'Mauvais login ou mot de passe.';
		}
		echo json_encode($jsonResponse);
	break;
	
	case 'suscribe':
		header('content-type:text/json');
		$response = array('error'=>array());
		if(!filter_var($_['login'], FILTER_VALIDATE_EMAIL) ||  strlen($_['password'])<6) $response['error'][] = 'Identifiant ou mot de passe non conformes';
		$q = $botsphinx[$_['robot-num']];
		if($q[1] != $_['robot']) $response['error'][] = 'Mauvaise réponse à la question anti-robot.';
		
		if(count($response['error']) == 0){
			try{
			$confirm = sha1(rand(0,1000).time());
			$url = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$link = dirname($url).'/action.php?action=confirmSubscription&c='.$confirm;
			@mail($_['login'],'[WIKI] Confirmation d\'inscription','Veuillez confirmer votre inscription au wiki en cliquant sur le lien suivant <a href="'.$link.'">'.$link.'</a>');
			$users = getDb(USER_DB);
			$users[] = (object) array('confirm'=>$confirm,'login'=>$_['login'],'rank'=>'user','password'=>sha1($_['password']));
			saveDb(USER_DB,$users);
			}catch(Exception $e){
				$response['error'][] = $e;
			}
		}
		echo json_encode($response);
	break;
	
	case 'confirmSubscription':
		$users = getDb(USER_DB);
		$current = false;
		foreach($users as $key=>$user){
			if(isset($user['confirm']) && $_['c']==$user['confirm']){
				unset($users[$key]['confirm']);
				$current = $user; 
			}
		}
		if($current==false){
			echo 'Ce code de validation ne correspond à aucun compte';
		}else{
			saveDb(USER_DB,$users);
			header('location:index.php?message=Inscription confirmée, vous pouvez vous identifier.');
		}
	break;
	
	case 'suscribeForm':
		$k = rand(0,count($botsphinx)-1);
		$q = $botsphinx[$k];
		echo '
			<h1>Inscription</h1>
			<p>Merci de bien vouloir répondre aux questions ci dessous.</p>
			<form id="suscribe-form">
			<label for="login">E-mail</label> : <br/><input type="text" style="width:150px;padding:3px;" id="login"><br/>
			<label for="password">Mot de passe</label>  : <br/><input type="password" style="width:150px;padding:3px;" id="password"><br/>
			<label for="password-confirm">Confirmation mot de passe :</label> <br/><input type="password" style="width:150px;padding:3px;" id="password-confirm"><br/>
			<label for="robot">'.$q[0].' :</label> <br/><input type="text" style="width:150px;padding:3px;" id="robot"><input id="robot-num" value="'.$k.'" type="hidden"><br/>
			<button id="button-suscribe" onclick="sendSuscribe();">Inscription</button>
		</form>';
	break;
	
	case 'logout':
			unset($_SESSION['user']);
			session_destroy();
	break;
	
	case 'loginBar':
		if(!$myUser){ ?>
			<input type="text" name="input-login" placeholder="Email" id="input-login"/> <input type="password" placeholder="Password" name="input-password" id="input-password"/> 
			<div id="button-login" onclick="login();">Login</div> | 
			<div id="button-suscribe" onclick="suscribe();">Inscription</div>
		<?php }else{ ?>
			Identifié avec <span class="emphasis" title="Rang : <?php echo $myUser->rank; ?> - Droits :<?php echo "\r\n".implode(','."\r\n",$myUser->rights); ?>"><?php echo $myUser->login; ?></span> - <a onclick="disconnect()">Déconnexion</a>
		<?php } 
	break;
	
	case 'menu':
		$menuContent = file_exists($menuPath)?file_get_contents($menuPath):MD_MENU_DEFAUT_CONTENT;
		echo Parsedown::instance()->parse($menuContent);
	break;

	case 'deleteFile':
		if($myUser!=false && $myUser->can('DELETE_FILE')){
			unlink($_['file']);
			$jsonResponse['success'] = true;
		}else{
			$jsonResponse['message'] = 'Vous ne pouvez pas editer tant que vous n\'êtes pas connecté.';
		}
		echo json_encode($jsonResponse);
	break;

	case 'rss':
		header('Content-Type: text/xml; charset=utf-8');
		$events = getEvents();
		
		if(!file_exists(CACHE_RSS) || (time()-filemtime(CACHE_RSS))>REFRESH_RSS_TIME ){
	
			$rss = new Rss(APPLICATION_TITLE,$_SERVER['REMOTE_ADDR']);
			foreach($events as $event){
				switch($event->type){
					case 'UPDATE_FILE':
						$title = $event->user.' a modifié la page '.$event->page.' le '.$event->date;
					break;
				}
				$rss->add($title,$event->date,$event->link,$title);
			}
			file_put_contents(CACHE_RSS,$rss->publish());
		}	
		echo file_get_contents(CACHE_RSS);
	break;

	case 'files':
		$keyword = strtolower(isset($_['keyword'])?$_['keyword']:'');
		$files = glob(UPLOAD_FOLDER.'/*/*/*'.$keyword.'*');
		
		foreach($files as $file){
			if(is_file($file)){
				$onclick  = '';
				$dotpos = strrpos($file,'.');
				$extension = $dotpos!==false?strtoupper(substr($file,$dotpos+1)):'';
				switch($extension){
					case 'JPG':
                    case 'JPEG':
                    case 'PNG':
                    case 'GIF':
                    case 'BMP':
                    case 'SVG':
						$onclick = '![id]('.$file.')';
					break;
					case 'video':
					break;
					case 'sound':
					break;
					default:
						$onclick = '['.$file.']('.$file.')';
					break;
				}
			?>
				<li><div class="file-name" onclick="appendText('<?php echo $onclick ;?>');"><img src="img/icon-file.png" align="absmiddle"> <?php 
				$name = basename($file);
				echo strlen($name)>25?substr($name,0,25).'...':$name;
				?></div><div onclick="deleteFile('<?php echo $file; ?>',this)" class="icon-file-delete"></div> <!--<div class="icon-file-setting"></div>--><div class="clear"></div></li>
			<?php
			}
		}			
	break;

	case 'upload':
			if(!$myUser ||  !$myUser->can('UPLOAD_FILE') ) exit();
				if(array_key_exists('files',$_FILES) && $_FILES['files']['error'][0] == 0 ){
					$pic = $_FILES['files'];
					$pic['name'] = utf8_decode($pic['name'][0]);
					$pic['name'] = stripslashes($pic['name']);
					$pic['tmp_name'] = $pic['tmp_name'][0];

					$dotpos = strrpos($pic['name'],'.');
					$extension = $dotpos!==false?strtoupper(substr($pic['name'],$dotpos+1)):'';

					$size = filesize($pic['tmp_name']);
					

					if($size<=(MAX_UPLOAD_SIZE*1048576)){

						$month = date('m').'/';
						$year = date('Y').'/';
						if(!file_exists('./'.UPLOAD_FOLDER)) mkdir('./'.UPLOAD_FOLDER);
						if(!file_exists('./'.UPLOAD_FOLDER.$year)) mkdir('./'.UPLOAD_FOLDER.$year);
						if(!file_exists('./'.UPLOAD_FOLDER.$year.$month)) mkdir('./'.UPLOAD_FOLDER.$year.$month);

						$destination = './'.UPLOAD_FOLDER.$year.$month.strtolower($pic['name']);

						if(move_uploaded_file($pic['tmp_name'], $destination)){
							$javascript['status'] = 'Fichier envoy&eacute; avec succ&egrave;s!';
							$javascript['extension'] = $extension;
							$javascript['succes'] = true;
							$javascript['path'] = $destination ;
							$javascript['file'] = $pic['name'];
						}
					}else{
						$javascript['status'] = 'Taille maximale : %Mo d&eacute;pass&eacute;e'.MAX_UPLOAD_SIZE;
					}
				}else{
					$javascript['status'] = 'Probl&egrave;me rencontr&eacute; lors de l\'upload';
				}
				echo json_encode($javascript);
			
	break;
	default:
		exit('Aucune action spécifiée...');
	break;
}
?>