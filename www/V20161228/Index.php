<?php
require_once('boot/01__boot.php');

loopInclude($GLOBALS['PATHS']['steps']);
/*
require_once('01_security.php');
require_once('02_get.php');
require_once('03_post.php');
require_once('04_list.php');
require_once('05_replace-tags.php');
require_once('06_htmlCommon.php');
*/
?>
<?php
/*
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Dépanneuses | Treuils tirage de câble | Matériels pose de fibre optique | Signalisation | Accessoires">
		<meta name='robots' content='noarchive'>
		<title>::::2014::</title>
		<link rel="shortcut icon" href="images/favicons/favicon.ico?v=1">
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/global.css">
	</head>

	<body>
		<div class='login' style='float:right;'>
			<form id='form_<?php echo getUidOnPage(); ?>' 
				action='<?php echo $GLOBALS['PATHS']['httpRoot'].$GLOBALS['askedPage']['allArgs']; ?>'
				accept-charset="UTF-8" method='post' enctype='multipart/form-data' target='_self'
				style='float:left;'>
				<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][software]"	value="admin">
				<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][command]"	value="login">
				<input type='text'		name="action[<?php echo $uidOnPage; ?>][username]"	value="alex@alex.wz" size="20">
				<input type='password'	name="action[<?php echo $uidOnPage; ?>][password]"	value="alex" size="10">
				<input type='button'	name='buttonSendForm_<?php echo $uidOnPage; ?>'		value="admin, login" onclick='document.getElementById("form_<?php echo $uidOnPage; ?>").submit();'>
			</form>
			<form id='form_<?php echo getUidOnPage(); ?>' 
				action='<?php echo $GLOBALS['PATHS']['httpRoot'].$GLOBALS['askedPage']['allArgs']; ?>'
				accept-charset="UTF-8" method='post' enctype='multipart/form-data' target='_self'
				style='float:left;'>
				<input type='button'	name='buttonSendForm_<?php echo $uidOnPage; ?>'		value="admin, logout" onclick='document.getElementById("form_<?php echo $uidOnPage; ?>").submit();'>
				<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][software]"	value="admin">
				<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][command]"	value="logout">
			</form>
		</div>
<br>
<br>
<br>
<br>	
		<form id='pack_action-<?php echo getUidOnPage(); ?>' 
			action='<?php echo $GLOBALS['PATHS']['httpRoot'].$GLOBALS['askedPage']['allArgs']; ?>'
			accept-charset="UTF-8" method='post' enctype='multipart/form-data' target='_self'>
			<input type='button'	name='b1Name' value=" article, update &amp; delete" onclick='document.getElementById("pack_action-<?php echo $uidOnPage; ?>").submit();'>
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][software]" value="admin">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][command]"  value="update">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][type]"     value="article">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][id]"       value="articleUuid">
			<input type="text"		name="action[<?php echo $uidOnPage; ?>][text]"     value="texte de action1 de l'ensemble 1" size="40">
			<input type="checkbox"	name="action[<?php echo $uidOnPage; ?>][check]"    value="dkn">

			<input type='hidden'   name="action[<?php echo getUidOnPage(); ?>][software]" value="admin">
			<input type='hidden'   name="action[<?php echo $uidOnPage; ?>][command]"  value="delete">
			<input type='hidden'   name="action[<?php echo $uidOnPage; ?>][type]"     value="article">
			<input type='hidden'   name="action[<?php echo $uidOnPage; ?>][id]"       value="articleUuid">
			<input type="text" 	   name="action[<?php echo $uidOnPage; ?>][text]"     value="texte de action2 de l'ensemble 1" size="40">
			<input type="radio"    name="action[<?php echo $uidOnPage; ?>][radio]"    value="rad">
		</form>
		
		
		<form id='pack_action-<?php echo getUidOnPage(); ?>' 
			action='<?php echo $GLOBALS['PATHS']['httpRoot'].$GLOBALS['askedPage']['allArgs']; ?>'
			accept-charset="UTF-8" method='post' enctype='multipart/form-data' target='_self'>
			<input type='button' name='b2Name' value="rubrique, create" onclick='document.getElementById("pack_action-<?php echo $uidOnPage; ?>").submit();'>
			<input type='hidden'   name="action[action3Uuid][software]" value="admin">
			<input type='hidden'   name="action[action3Uuid][command]"  value="create">
			<input type='hidden'   name="action[action3Uuid][type]"     value="rubrique">
			<input type='hidden'   name="action[action3Uuid][in]"       value="parentUuid">
			<input type='hidden'   name="action[action3Uuid][occ]"      value="parentOccurence">
			<input type='hidden'   name="action[action3Uuid][rank]"     value="1">
			<input type="text" 	   name="action[action3Uuid][title]"    value="Titre de la rubrique" size="40">
		</form>

		
		<form id='pack_action-<?php echo getUidOnPage(); ?>' 
			action='<?php echo $GLOBALS['PATHS']['httpRoot'].$GLOBALS['askedPage']['allArgs']; ?>'
			accept-charset="UTF-8" method='post' enctype='multipart/form-data' target='_self'>
			<input type='button'	name='b1Name' value=" BAD SOFTWARE" onclick='document.getElementById("pack_action-<?php echo $uidOnPage; ?>").submit();'>
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][software]"  value="lol">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][command]"  value="update">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][type]"     value="article">
			<input type='hidden'	name="action[<?php echo $uidOnPage; ?>][id]"       value="articleUuid">
		</form>
	</body>
</html>
<?php
/*
#Génère des tableaux javascript:
//article['objX']{type:'remorque', nprop:'nval',..}
//page["remorque"]='html code with __remorque__ inside, where big block of contents will land';
//modele["remorque"]='html code with __tagx__ __tagy__  __tagZStart__ ...__tagZ__...__tagZStop__';


#Utilise les tableaux.


<!DOCTYPE html>
<html lang='fr'>
	<!-- HTML5 ;) -->
	<head>
	<meta charset="UTF-8">
	<meta name="description" content="www.CEV.com">
	<meta name='robots' content='noarchive'>
	<title>www.CEV.com | v2014</title>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	</head>
	
	<body>
	<script src="lib_js/dojo-release-1.8.3/dojo/dojo.js" data-dojo-config="async: false"></script>


	<div class='header' id='header'>
	<a href='http://www.cevam-treuil.com/'><img class='logo' src='http://www.cevam-treuil.com/images/Logo_CEV.jpg'></a>
	<br>
	<h1 class='titreFamille'>___Matériels pour la pose de câble________(depuis 1950)</h1>
	<br>
	<div id='navigation'></div>
	</div>
	
	<div class='content' id='content'>
	
	</div>
	<div class='footer' id='footer'>
	<table class='footerTable'>
	<tr><td>lun-ven: 08h30-12h00&nbsp;&nbsp;13h30-16h30&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Tél.</td><td>:</td><td>&nbsp;01.34.75.55.02</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Web</td><td>:</td><td>&nbsp;http://www.cevam-treuil.com</td></tr>
	<tr><td></td><td>Fax </td><td>:</td><td>&nbsp;01.34.75.58.47</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gps</td><td>:</td><td>&nbsp;48.949055, 1.933336</td></tr>
	<tr><td></td><td>Mail </td><td>:</td><td>&nbsp;commercial@cev-treuil.com</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
	<tr><td></td><td>Adresse</td><td>:</td><td colspan='4'>&nbsp;ZAC du petit parc, 17 rue des Fontenelles, 78920 Ecquevilly France
	</table>
	</div>
	</body>
</html>
*/
?>