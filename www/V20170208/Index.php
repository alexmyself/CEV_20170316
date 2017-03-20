<?php
require_once('boot/01__boot.php');
loopInclude($GLOBALS['PATHS']['steps']);
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
*/
?>