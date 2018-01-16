<?php
$cont_sin=1000;
$cont_doc=200;
$conexion = mysql_connect("localhost", "root", "admin");
mysql_select_db("gardms", $conexion);
$response="Successful:Inserción satisfactoria";
for($i=0;$i<=$cont_sin;$i++){
	$rama="ram-".$i;
	$codSiniestro="cod-".$i;
	$fecha=date("Y-m-d H:i:s");
	$sql="INSERT INTO `gardms`.`siniestros` (`codRama`, `codSiniestro`, `timestampCreacion`) VALUES ('$rama', '$codSiniestro', '$fecha')";
	$resultado1=mysql_query($sql);
	$lastCodSiniestro=mysql_insert_id();
	for($j=0;$j<=$cont_doc;$j++){
		$sql="INSERT INTO `gardms`.`documentos` (`nombre`,`Path`, `idsiniestros`, `timestampCreacion`) VALUES ('','',$lastCodSiniestro,'$fecha')";
		$resultado2=mysql_query($sql);
	}
}
echo $response;
mysql_close($conexion);

?>
