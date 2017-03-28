<?php
###############################################################################
##ITEMS models filling and packing
#Replace tags in model with object values.
foreach($GLOBALS['itemsData'] as $keyContainer => $container){
	if(is_array($container) && (count($container) > 0)){
		foreach ($container as $keyItem => $item) {
			if( is_array($item['model']) && (count($item['model']) > 0) ){
				$GLOBALS['itemsData'][$keyContainer][$keyItem]['model']['model']= replacementMotor(array('dataArr'=> $item['data'], 'modelStr'=> $item['model']['model']) );
			}
		}
	}
}
?>