<?php
#Renvoi un tableau contenant les entrées du répertoire $path en filtrant via les options suivantes:
#all : aucun filtre, toutes les entrées sont renvoyées.
#dirs : renvoi uniquement les répertoires.
#files : renvoie uniquement les fichiers.
# Renvoi false si aucun contenu n'est trouvé.

function lister($path, $filtre){
$dir = opendir($path);
while (false !== ($entry = readdir($dir))) {
        $pathList[]= $entry;
    }
	//$pathList = scandir($path)? scandir($path) : die(debug('invalid path: '.$path));
	$finalList = array();
	foreach($pathList as $entry){
		if($entry == '.' || $entry == '..'){ continue;}
		if ($filtre == 'all'){ $finalList[] = $path.DIRECTORY_SEPARATOR.$entry;}
		elseif ($filtre == 'dirs'  && is_dir ($path.DIRECTORY_SEPARATOR.$entry)){ $finalList[] = $path.DIRECTORY_SEPARATOR.$entry;}
		elseif ($filtre == 'files' && is_file($path.DIRECTORY_SEPARATOR.$entry)){ $finalList[] = $path.DIRECTORY_SEPARATOR.$entry;}
		}
	if(empty($finalList)){ return false;}
	natcasesort($finalList);
	return $finalList;
	}
?>