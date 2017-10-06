<?php 
	function login($user,$password)
    {
    	if (($user == 'leo' || $user == 'juan' || $user == 'pedro' || $user == 'otro') && $password=="123") {
    		return 1;
    	}else{
    		return 0;
    	}
      
    } 

    function verify($user, $password){
    	if($user=='leo'){
    		return 3;
    	}
    	if($user=='juan'){
    		return 2;
    	}
    	if($user=='pedro'){
    		return 1;
    	}
    	if(!$user==''){
    		return 0;
    	}

    }
?>