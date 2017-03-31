// Lock / unlock flag to avoid multiple calls (window resize fires many many times on ie..)
// Starts locked to decide when things can debut.
lockState = true;

lock = function(){
	if(lockState === false){
		lockState = true;
		return true;
	}
	else{return false;}
}

unlock = function(){lockState = false;}