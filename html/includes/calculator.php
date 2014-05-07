<?php

//deny all except ajax
//if ( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ){
//	die('Invalid access');
//}

function error($message) {
	$output = array(
		'error' => true,
		'message' => $message
	);
	echo json_encode($output);
}

//Check for vars
if( !isset($_GET['doba_splaceni']) || !isset($_GET['vyse_uveru']) ) {
	error('Vars were not passed');
	exit();
}

$doba_splaceni = (int)$_GET['doba_splaceni'];
$vyse_uveru = (int)$_GET['vyse_uveru'];

//Check for correct vals
$doba_splaceni_valid = array();
for( $i = 1; $i <= 20; $i++ ) {
	$doba_splaceni_valid[] = $i;
}
$vyse_uveru_valid = array();
for( $i = 1; $i <= 30; $i++ ) {
	$vyse_uveru_valid[] = $i * 100000;
}
if( !in_array( $doba_splaceni, $doba_splaceni_valid ) || !in_array( $vyse_uveru, $vyse_uveru_valid ) ) {
	error( 'Invalid entry' );
	exit();
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

$output = array(
	'splatka' => $splatka,
	'rpsn' => $rpsn
);

echo json_encode($output);