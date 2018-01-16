<?php
if(exec('echo EXEC',$out) == 'EXEC'){
	echo("El comando exec esta instalado correctamente");
}
else{
	echo("Error:El comando exec no esta instalado correctamente");
}
?>
