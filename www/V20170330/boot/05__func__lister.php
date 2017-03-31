<?php
#Renvoi un tableau contenant les entrées du répertoire $path en filtrant via les options suivantes:
#all : aucun filtre, toutes les entrées sont renvoyées.
#dirs : renvoi uniquement les répertoires.
#files : renvoie uniquement les fichiers.
# Renvoi false si aucun contenu n'est trouvé.

function lister($path, $filtre){
	if(is_dir($path)===false){return false;}
	$path = preg_replace('~'.preg_quote(DIRECTORY_SEPARATOR).'$~','',$path);
	$dir = opendir($path);
	$finalList = array();
	while (false !== ($entry = readdir($dir))) {
		if($entry == '.' || $entry == '..'){ continue;}
		$entryPath=$path.DIRECTORY_SEPARATOR.$entry;
		if ($filtre == 'all'){ $finalList[] = $entryPath;}
		elseif ($filtre == 'dirs'  && is_dir ($entryPath)){ $finalList[] = $entryPath;}
		elseif ($filtre == 'files' && is_file($entryPath)){ $finalList[] = $entryPath;}
	}
	if(empty($finalList)){ return false;}
	natSortArr($finalList);
	return $finalList;
}
?>