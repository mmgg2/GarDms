<?php
/* @var $this ModeratorDocumentosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Moderator Documentoses',
);

$this->menu=array(
	array('label'=>'Create ModeratorDocumentos', 'url'=>array('create')),
	array('label'=>'Manage ModeratorDocumentos', 'url'=>array('admin')),
);
?>

<h1>Moderator Documentoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
