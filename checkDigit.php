<?php
/************************************************
 File: checkDigit.php
 Created: 23-May-2017
 Author: Ramiro Vidal
 Notes: Function to verify the check digit !
*************************************************/



function checkDigit($upc, $returnDigit = false){
	$submitedUpc = $upc;
	
	
	if(strlen($upc) == 14){
		$upc = substr($upc,0,13);
	}elseif (strlen($upc) == 12 ) {
		$upc = substr($upc,0,11);
	}else if ( strlen($upc) == 11){
		// we do nothing... asume check digit is not present !.
	}elseif(strlen($upc) == 8){
		$upc = substr($upc,0,7);
	}else{
		return false;
		// Check digit not present !
	
	}

	$step1 = 0;
	$step2 = 0;
	
	
	// Get the odd numbers !
	for($i=0; $i < strlen($upc); $i +=2 ){
		$step1 += $upc{$i};
	}
	$step1 *= 3;


	//Sum even numbers !
	for($i=1; $i < strlen($upc); $i+=2 ){
		$step2 += $upc{$i};
	}
	
	
	$totalSum = $step1 + $step2;
	
	$checkDigit = $totalSum % 10;
	$checkDigit = 10 - $checkDigit;
	
	// get the last digit of the upc
	$lastDigit = substr($submitedUpc,strlen($submitedUpc) -1,1);
	
	if( $returnDigit == true){
		return $checkDigit;
	}else{
	
		if($checkDigit == $lastDigit){
			return true;
			// Check Digit validation pass
		}else{
			// check digit validation error !
			return false;
		
		}
	}

}



?>
