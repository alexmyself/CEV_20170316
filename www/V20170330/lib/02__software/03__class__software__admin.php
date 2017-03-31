<?php
/*
class admin{
	function __construct(&$myMeta){
		$this->myMeta = $myMeta;
		$this->okToRun = $this->login();
		$GLOBALS['askedPage']['model'] = ($this->okToRun == true)? 'admin' : $GLOBALS['askedPage']['modelByDefault'];
		htmlGetParamsRebuild();
	}
	var $myMeta;
	var $okToRun;

	function login(){
		$userDat['software']='user';
		$userDat['command']='login';
		$userDat['username']= (isset($this->myMeta->packOfData['username']))? $this->myMeta->packOfData['username'] : null;
		$userDat['password']= (isset($this->myMeta->packOfData['password']))? $this->myMeta->packOfData['password'] : null;
		$userObj = new metaSoftware($this,$userDat);
		return $userObj->result;
	}
	function logout(){
		$userDat['software']='user';
		$userDat['command']='logout';
		$userObj = new metaSoftware($this,$userDat);
		if ($GLOBALS['askedPage']['model'] == 'admin'){
			$GLOBALS['askedPage']['model'] = 'default';
			htmlGetParamsRebuild();
		}
		return $userObj->result;
	}

	function update(){return $this->myMeta->display_info();}
	function delete(){return $this->myMeta->display_info();}
	function create(){return $this->myMeta->display_info();}
}
*/
?>