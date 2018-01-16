<?php

	$rama=$_GET["rama"];
	$codSiniestro=$_GET["codSiniestro"];
	$path=$_GET["path"];
	$fecha=date("Y-m-d H:i:s");
	$nomSplit=explode("/images/",$_GET["path"]);
	$nombre=explode(".",$nomSplit[1]);
	//echo("parametros:".$rama.$codSiniestro.$fecha);

 	$response="Successful:Inserción satisfactoria";
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
					$sql="INSERT INTO `gardms`.`documentos` (`nombre`,`Path`, `idsiniestros`, `timestampCreacion`) VALUES ('$nombre[0]','$path',$lastCodSiniestro,'$fecha')";
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
					$sql="INSERT INTO `gardms`.`documentos` (`nombre`,`Path`, `idsiniestros`, `timestampCreacion`) VALUES ('$nombre[0]','$path',$idsiniestros,'$fecha')";
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
	echo $response;

?>
