<?php
abstract class metaSoftware{
	function __construct(&$packOfData=null, &$parent=null){
		$this->parentObj 	= $parent;
		$this->packOfData 	= $packOfData;
		$this->result 		= false;
		if($this->login()!==true){return false;}
		$this->play();
	}

	protected 	$parentObj;
	protected 	$packOfData;
	public 		$result;
	abstract protected function login();
	abstract protected function play();

	public function info(){
		echo "\n\n\tFILE::".__FILE__;
		echo "\n\t\tCLASS::".__CLASS__;
		$par = (gettype($this->parentObj) == 'NULL')? '--none': get_class($this->parentObj);
		echo "\n\t\t\tParent: ".$par;
		foreach($this->packOfData as $commandName => $commandValue){echo "\n\t\t\tCommand: ".$commandName."\t=\t".$commandValue;}
	}
}





function softwareHandler($commandsArr){
	$className='software__'.$commandsArr['software'];
	$obj = new $className($commandsArr);
	$result= $obj->result;
	unset($obj);
	return $result;
}
?>