<?php
require_once('common.php');

if(file_exists(USER_DB)) exit(0);

if(isset($_['login'])){
	$users = getDb(USER_DB);
	$users[] = (object) array('login'=>$_['login'],'rank'=>'admin','password'=>sha1($_['password']));
	saveDb(USER_DB,$users);
	header('location: index.php');
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Plume</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/skin.css">
		<link rel="icon" type="image/png" href="favicon.png" />
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body onbeforeunload ="checkPendingTask();">
        <!--[if lt IE 7]>
            <p>Vous utilisez un navigateur <strong>obsolète</strong>. Si il vous plais, <a href="http://browsehappy.com/">mettez à jour votre naviguateur</a> afin d'améliorer votre naviguation.</p>
        <![endif]-->
		
        <!-- Add your site or application content here -->
        <div id='main-container' style="margin:auto;width:300px;">
		<div id="content">
			<h1>Installation</h1>
			<form id="installForm" action="install.php" method="POST">
			Login admin : <br/><input type="text" style="width:150px;padding:3px;" name="login"><br/>
			mdp admin : <br/><input type="password" style="width:150px;padding:3px;" name="password"><br/>
			mdp admin confirm : <br/><input type="password" style="width:150px;padding:3px;" name="passwordConfirm"><br/>
			
			<div onclick="validateForm();" style="text-align:center;background-color: #FFFFFF;border: 1px solid rgba(0, 0, 0, 0);border-radius: 3px;cursor: pointer;margin: 5px 5px 5px 0;padding: 3px;width:150px;">Installation</div>
			</form>
		</div>
		</div>
			<div class='clear'></div>
			<div id='footer-container'></div>
			<div id="UPDATE_URL" class="hidden"><?php echo UPDATE_URL; ?></div>
			<div id="APPLICATION_VERSION" class="hidden"><?php echo APPLICATION_VERSION; ?></div>
        <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script type="text/javascript" src="js/vendor/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="js/vendor/jquery.fileupload.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="js/vendor/jquery-litelighter.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.markitup.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
		<script>
			
			function validateForm(){
				if(!isEmail($('input[name=\'login\']').val())){
					message('Votre identifiant doit être un email');
					return;
				}
				if($('input[name=\'password\']').val().length<6){
					message('Votre mot de passe doit être composé d\'au moins 6 caracteres');
					return;
				}
				
				if($('input[name=\'password\']').val()!=$('input[name=\'passwordConfirm\']').val()){
					message('Les mots de pass ne correspondent pas');
					return;
				}
				$('#installForm').submit();
			}
		
		</script>
    </body>
</html>

