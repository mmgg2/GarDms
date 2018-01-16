<?php

require_once('nusoap-0.9.5/lib/nusoap.php');

$server = new nusoap_server;

$server->configureWSDL('server', 'urn:server');

$server->schemaTargetNamespace = 'urn:server';

$server->register('pollServer',
array('value' => 'xsd:string'),
array('return' => 'xsd:string'),
'urn:server',
'urn:server#pollServer');

function pollServer($value){

if($value['value'] == 'Good'){

return $value['value'].""."The value of the server poll resulted in good information";
}
else{

return $value['value'].""."The value of the server poll showed poor information";
}
}

//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service($HTTP_RAW_POST_DATA);

?>
