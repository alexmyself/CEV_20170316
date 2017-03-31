<?php
#Against "Cross-Site Request Forgery"
#(sending POST form from connected browser browsing a pirate page,
# the page "pirate.com" contains a post form wich is sent to gmail for example, if user is connected in his browser gmail will apply)
if(isset($_SERVER['HTTP_REFERER'])
	#si le referer n'est pas "off" (option ou défault dans les navigateurs)
	&& $_SERVER['HTTP_REFERER']!=''
	#et qu'il est différent du nom de domaine
	&& substr($_SERVER['HTTP_REFERER'], 7, strlen($_SERVER['SERVER_NAME'])) != $_SERVER['SERVER_NAME']){
	$_POST = array();
}

#Remove html & php tag, start and trailing spaces
function clean(&$var){
	if(is_array($var)){array_map('clean', $var);}
	else{
		$var = strip_tags($var);
		$var = trim($var);
	}
}
clean($_GET);
clean($_POST);

#For tactical pages (like admin),
#Use an unique id once. if more than once or absent, we display home page and reset $_post & $_get and logout from: admin.
session_start();
$_SESSION['pageId'][]= $GLOBALS['uidNow'];
$GLOBALS['critical'] = false;
$GLOBALS['logoutCriticals'][]='admin';

function tempFunc($val, $key){
	if($key=='software' && $val=='admin'){$GLOBALS['critical'] = true;}
}

if(array_key_exists('action', $_POST) && is_array($_POST['action'])){ array_walk_recursive( $_POST['action'], 'tempFunc');}
if($GLOBALS['critical'] == true){
	if( in_array($_GET['pageId'], $_SESSION['pageId'])==false){
		$_GET = array();
		$_POST = array();
		# logout from any critical things
		foreach($GLOBALS['logoutCriticals'] as $programToLogout){
			$obj = new $programToLogout($nothing);
			$obj->logout();
		}
	}
	else{
		unset($_SESSION['pageId'][array_search($_GET['pageId'],$_SESSION['pageId'])]);
		$_SESSION['pageId'] = array_values($_SESSION['pageId']);
	}
}
?>