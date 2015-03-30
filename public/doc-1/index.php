<?php
require_once('common.php');
if(!file_exists(USER_DB)) header('location: install.php');

//Lecture de la page courante et conversion markdown/html
$pageContent = file_exists($pagePath) ? file_get_contents($pagePath) : 'Le contenu de  **'.$page.'** est vide :p';
//Mode lecture/mode edition
$pageContent = Parsedown::instance()->parse($pageContent);

$menuPath = MD_ROOT."menu".MD_EXTENSION;
$menu = Parsedown::instance()->parse(file_exists($menuPath) ? file_get_contents($menuPath) : 'Page de menu supprimé');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Basix WordPress Theme Documentation</title>
	<style type="text/css">
		html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
			margin: 0;
			padding: 0;
			border: 0;
			outline: 0;
			font-size: 100%;
			vertical-align: baseline;
			background: transparent;
		}
		html, body {
			height: 100%;
		}
		ol, ul {
			list-style: none;
			margin-top: 8px;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after, q:before, q:after {
			content: '';
			content: none;
		}
		:focus {
			outline: 0;
		}
		ins {
			text-decoration: none;
		}
		del {
			text-decoration: line-through;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		body {
			background-color: #ffffff;
			font-family: Arial, SunSans-Regular, Sans-Serif;
			font-size: 14px;
			line-height: 1.6em;
			color: #666666;
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			width: auto;
		}
		a {
			color: #dd4952;
			text-decoration: none;
		}
		a:hover {
			color: #2f3338;
		}
		h1 {
			font-size: 110px;
			font-weight: bold;
			letter-spacing: -4px;
			color: #2f3338;
			margin-bottom: 10px;
			margin-left: -4px;
			line-height: 1.1em;
		}
		h3 {
			color: #2f3338;
			font-size: 22px;
			margin-bottom: 30px;
		}
		h4 {
			color: #2f3338;
			font-size: 14px;
			margin-bottom: 15px;
			margin-top: 32px;
		}
		p {
			margin-bottom: 15px;
		}
		#content ul {
			margin-bottom: 30px;
		}
		#content li ul {
			margin-top: 10px;
		}
		ul:last-child {
			margin-bottom: 0;
		}
		li {
			line-height: 18px;
		}
		.container {
			width: 850px;
			margin: 0 auto;
			padding-top: 30px;
			padding-right: 30px;
			position: relative;
			background-color: #ffffff;
		}
		#menu {
			position: fixed;
			width: 200px;
			padding: 0;
			margin: 0;
			top: 40px;
			font-size: 14px;
		}
		#menu li {
			margin-bottom: 12px;
		}
		.spacer {
			height: 40px;
			display: block;
		}
		#content {
			margin-left: 220px;
			background-color: #fff;
			overflow: auto;
		}
		#content ul {
			list-style: circle;
			list-style-position: outside;
			margin-left: 18px;
		}
		#content li {
			margin-bottom: 8px;
		}
		.anchor {
			margin-top: 10px;
		}
		.section {
			margin-bottom: 36px;
			padding-bottom: 32px;
			border-bottom: 2px solid #dadada;
			float: left;
			width: 100%;
		}
		.section:last-child {
			border-bottom: none;
		}
		.welcome p {
			font-size: 18px;
			line-height: 26px;
			color: #aaaaaa;
		}
		code {
			background-color: #e2e2e2;
			display: block;
			padding: 10px;
			line-height: 18px;
			margin-bottom: 20px;
		}
		.Menu Setup {
			margin-bottom: 30px;
		}
		a.top {
			position: fixed;
			bottom: 8px;
			right: 8px;
			width: 20px;
			height: 20px;
			padding: 6px;
			color: #fff;
			background-color: rgba(0, 0, 0, 0.4);
			background-image: url(images/top.png);
			background-repeat: no-repeat;
			background-position: center center;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
	</style>
</head>

    <body onbeforeunload ="checkPendingTask();">
        <!--[if lt IE 7]>
            <p>Vous utilisez un navigateur <strong>obsolète</strong>. Si il vous plais, <a href="http://browsehappy.com/">mettez à jour votre naviguateur</a> afin d'améliorer votre naviguation.</p>
        <![endif]-->
		
        <!-- Add your site or application content here -->

		<div class="container">
			<div id="menu">
				<?php echo stripslashes($menu); ?>
			</div>
			<div id="content">
				<?php echo stripslashes($pageContent); ?>
			</div>
		</div>
	    <!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
	    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script type="text/javascript" src="js/vendor/jquery.ui.widget.js"></script>
	    <script type="text/javascript" src="js/vendor/jquery.fileupload.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="js/vendor/jquery-litelighter.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.markitup.js"></script>
		<script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>