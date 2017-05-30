<?php

/************************************************
 File: upceToupca.php
 Created: 29-May-2017
 Author: Ramiro Vidal
 Notes: Function to convert from UPC-e to UPC-A

*************************************************/

function convertUpc($upc){

	if( strlen($upc) ==6){
		// Tenemos el medio sin checksum
		// ok !
		$upce = $upc;
	}else if( strlen($upc) ==7){
		// We got the upc we assume we got the check digit !
		$upce = substr($upc,0,6);
	}else if(strlen($upc) == 8){
		$upce = substr($upc,1,6);
	}else{
		return false;
	}
	
	//print $upce;
	
	//Break $upce in 6 digits !
	$d1 = $upce{0};
	$d2 = $upce{1};
	$d3 = $upce{2};
	$d4 = $upce{3};
	$d5 = $upce{4};
	$d6 = $upce{5};
	
	
	
	if($d6 == "0" or $d6 == "1" or $d6 == "2"){
		$manufacturer = $d1.$d2.$d6.'00' ;
		$itemNumber = '00'. $d3.$d4.$d5;
	}elseif($d6 == "3"){
		$manufacturer = $d1.$d2.$d3 . '00';
		$itemNumber = '000' .$d4 . $d5;
	}else if ($d6 == "4"){
		$manufacturer = $d1.$d2.$d3.$d4 .'0';
		$itemNumber = '0000'.$d5;
	}elseif($d6 > 4 and $d6 <= 9){
		$manufacturer = $d1.$d2.$d3.$d4.$d5;
		$itemNumber = '0000' . $d6;
	}else{
		return false;
		// unknow format ..
	}
	
	$upcA = '0'. $manufacturer.$itemNumber;
	$upcA .= checkDigit( $upcA, true); // add CheckDigit
	
	
	return $upcA;

}



?>