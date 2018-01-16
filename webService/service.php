<?php
// include NuSOAP library
require_once('nusoap-0.9.5/lib/nusoap.php');

error_reporting(5);

// Create Web Service Server
$server = new soap_server;

$server->configureWSDL('conectar', 'urn:conectar');
// Register Services


// (conectar) $server->register('conectar');
$server->register('conectar', //method name
array('name' => 'xsd:string'), // input parameters
array('return' => 'xsd:string'), // output parameters
'urn:conectar', // namespace
'urn:conectar#conectar', // soapaction
'rpc', // style
'encoded', // use
'Says hello to the caller' // documentation
);



// (insertDocument) $server->register('insertDocument');
$server->register('insertDocument', //method name
array('rama' => 'xsd:string','codSiniestro' => 'xsd:string','path' => 'xsd:string','nombre' => 'xsd:string'), // input parameters
array('return' => 'xsd:string'), // output parameters
'urn:insertDocument', // namespace
'urn:insertDocument#insertDocument', // soapaction
'rpc', // style
'encoded', // use
'insert a document in BD' // documentation
);


// Define functions
function conectar ($name){
	return "Conexión con web service con exito: ($name)";
}


function insertDocument ($rama,$codSiniestro,$path,$nombre){
	$response="Successful:Inserción satisfactoria";
	$fecha=date("Y-m-d H:i:s");
	try {
		$conexion = mysql_connect("localhost", "root", "admin");
		mysql_select_db("gardms", $conexion);
		$sql="SELECT * FROM `gardms`.`siniestros` where (`codRama`='$rama' AND `codSiniestro`='$codSiniestro')";
		$resultado1=mysql_query($sql);
		if(mysql_error()==""){
			if(mysql_num_rows($resultado1)==0){
				$sql="INSERT INTO `gardms`.`siniestros` (`codRama`, `codSiniestro`, `timestampCreacion`) VALUES ('$rama', '$codSiniestro', '$fecha')";
				$resultado2=mysql_query($sql);
				if(mysql_error()==""){
					$lastCodSiniestro=mysql_insert_id();
					$sql="INSERT INTO `gardms`.`documentos` (`nombre`,`Path`, `idsiniestros`, `timestampCreacion`) VALUES ('$nombre','$path',$lastCodSiniestro,'$fecha')";
					$resultado3=mysql_query($sql);
					if(mysql_error()!=""){
						$response="Error:".mysql_error();
					}
				}
				else{
					$response="Error:".mysql_error();
				}
			}
			else{
				while ($row = mysql_fetch_array($resultado1)) {
					$idsiniestros=$row{'idsiniestros'};
					$sql="INSERT INTO `gardms`.`documentos` (`nombre`,`Path`, `idsiniestros`, `timestampCreacion`) VALUES ('$nombre','$path',$idsiniestros,'$fecha')";
					$resultado3=mysql_query($sql);
					if(mysql_error()!=""){
						$response="Error:".mysql_error();
					}
				}
			}
		}
		else{
			$response="Error:".mysql_error();
		}
		mysql_close($conexion);
	}
	catch (Exception $e) {
		$response="Error:".$e->getMessage();
	}
	return $response;
}


$server->service($HTTP_RAW_POST_DATA);
?>
