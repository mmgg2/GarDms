<?php
/* @var $this ModeratorDocumentosController */
/* @var $model ModeratorDocumentos */

$this->breadcrumbs=array(
	'Moderator Documentoses'=>array('index'),
	$model->idmoderatorDocumentos,
);

$this->menu=array(
	array('label'=>'List ModeratorDocumentos', 'url'=>array('index')),
	array('label'=>'Create ModeratorDocumentos', 'url'=>array('create')),
	array('label'=>'Update ModeratorDocumentos', 'url'=>array('update', 'id'=>$model->idmoderatorDocumentos)),
	array('label'=>'Delete ModeratorDocumentos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idmoderatorDocumentos),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ModeratorDocumentos', 'url'=>array('admin')),
);
?>

<h1>View ModeratorDocumentos #<?php echo $model->idmoderatorDocumentos; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idmoderatorDocumentos',
		'id_object',
		'isSiniestro',
		'create',
		'username',
	),
)); ?>
