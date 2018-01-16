<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */

$this->breadcrumbs=array(
	'Siniestroses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Siniestros', 'url'=>array('index')),
	array('label'=>'Manage Siniestros', 'url'=>array('admin')),
);
?>

<h1>Create Siniestros</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>