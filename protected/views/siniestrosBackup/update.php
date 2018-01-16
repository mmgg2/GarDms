<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */

/*
$this->breadcrumbs=array(
	'Siniestroses'=>array('index'),
	$model->idsiniestros=>array('view','id'=>$model->idsiniestros),
	'Update',
);
 
 */

$this->menu=array(
	//array('label'=>'List Siniestros', 'url'=>array('index')),
	//array('label'=>'Create Siniestros', 'url'=>array('create')),
	//array('label'=>'View Siniestros', 'url'=>array('view', 'id'=>$model->idsiniestros)),
	array('label'=>'Gestión Siniestros', 'url'=>array('admin')),
);
?>

<h1>Actualizar Siniestro <?php echo $model->codRama."-".$model->codSiniestro; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>