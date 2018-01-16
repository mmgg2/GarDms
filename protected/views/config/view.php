<?php
/* @var $this ConfigController */
/* @var $model Config */

$this->menu=array(
	array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->idconfig)),
);
?>

<h1>Configuraciones</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'idconfig',
		'correo_host',
		'correo_port',
		'correo_username',
		'correo_password',
		'correo_from',
		'correo_SMTPSecure',
		'db_host',
		'db_name',
		'db_username',
		'db_password',
	),
)); ?>
