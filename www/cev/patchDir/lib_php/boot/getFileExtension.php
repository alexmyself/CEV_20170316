<?php
function getFileExtension($filename){
	//Remplace tout ce qui match:
	//		si le sous masque match "(?=" ou si il ne match pas "(?!"
	//		sauf le contenu du sous masque
	//Dans les regexp ca s'appelle des "lookaround", "lookahead", "lookbehind"
	return preg_replace('/.*\.(?=[^\.]+$)/','', $filename);	
}
?>