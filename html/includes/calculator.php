<?php

function calculate($vyse_uveru, $doba_splaceni) {

	//Check for correct vals
	$doba_splaceni_valid = array();
	for( $i = 1; $i <= 20; $i++ ) {
		$doba_splaceni_valid[] = $i;
	}
	$vyse_uveru_valid = array();
	for( $i = 1; $i <= 30; $i++ ) {
		$vyse_uveru_valid[] = $i * 100000;
	}
	$vyse_uveru_valid[] = 150000;
	$vyse_uveru_valid[] = 250000;
	$vyse_uveru_valid[] = 350000;
	$vyse_uveru_valid[] = 450000;
	if( !in_array( $doba_splaceni, $doba_splaceni_valid ) || !in_array( $vyse_uveru, $vyse_uveru_valid ) ) {
		error( 'Invalid entry' );
		die();
	}

	$client = new SoapClient("http://ws.freenets.cz/RpsnKalkulator/RpsnKalkulator.svc?Wsdl");

	$obj = new stdClass();
	$obj->VysePucjky = $vyse_uveru;
	$obj->Urok = 13.99;
	$obj->PocetSplatek = $doba_splaceni * 12;
	$obj->PoplatekDo200Tisic = 12500;
	$obj->PoplatekOd200TisicProcent = 5;

	$retval = $client->GetSplatka($obj);
	$splatka = $retval->GetSplatkaResult;

	$retval = $client->GetRpsn($obj);
	$rpsn = $retval->GetRpsnResult;

	return array(
		'splatka' => $splatka,
		'rpsn' => $rpsn
	);
}

function error($message) {
	$output = array(
		'error' => true,
		'message' => $message
	);
	echo json_encode($output);
}

global $include_secret;
if( $include_secret != 'secret' ) {


	//deny all except ajax
	//if ( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ){
	//	die('Invalid access');
	//}



//Check for vars
	if( !isset($_GET['doba_splaceni']) || !isset($_GET['vyse_uveru']) ) {
		error('Vars were not passed');
		exit();
	}

	$doba_splaceni = (int)$_GET['doba_splaceni'];
	$vyse_uveru = (int)$_GET['vyse_uveru'];

	$output = calculate($vyse_uveru, $doba_splaceni);

	echo json_encode($output);


}

