<?php
/* @var $this SiniestrosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Siniestroses',
);

$this->menu=array(
	array('label'=>'Create Siniestros', 'url'=>array('create')),
	array('label'=>'Manage Siniestros', 'url'=>array('admin')),
);
?>

<h1>Siniestroses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
