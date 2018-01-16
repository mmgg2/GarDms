<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	$model->id_documentos,
);

$this->menu=array(
	array('label'=>'List Documentos', 'url'=>array('index')),
	array('label'=>'Create Documentos', 'url'=>array('create')),
	array('label'=>'Update Documentos', 'url'=>array('update', 'id'=>$model->id_documentos)),
	array('label'=>'Delete Documentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_documentos),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documentos', 'url'=>array('admin')),
);
?>

<h1>Documento: <?php echo $model->descripcion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_documentos',
		'descripcion',
		'Path',
		'etiqueta',
		'idsiniestros',
	),
)); ?>
