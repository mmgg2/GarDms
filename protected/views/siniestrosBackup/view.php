<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */

$this->breadcrumbs=array(
	'Siniestroses'=>array('index'),
	$model->idsiniestros,
);

$this->menu=array(
	array('label'=>'List Siniestros', 'url'=>array('index')),
	array('label'=>'Create Siniestros', 'url'=>array('create')),
	array('label'=>'Update Siniestros', 'url'=>array('update', 'id'=>$model->idsiniestros)),
	array('label'=>'Delete Siniestros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idsiniestros),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Siniestros', 'url'=>array('admin')),
);
?>

<h1>View Siniestros #<?php echo $model->idsiniestros; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idsiniestros',
		'descripcion',
                'etiqueta',
	),
)); ?>
