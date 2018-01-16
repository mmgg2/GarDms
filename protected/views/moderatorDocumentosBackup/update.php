<?php
/* @var $this ModeratorDocumentosController */
/* @var $model ModeratorDocumentos */

$this->breadcrumbs=array(
	'Moderator Documentoses'=>array('index'),
	$model->idmoderatorDocumentos=>array('view','id'=>$model->idmoderatorDocumentos),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModeratorDocumentos', 'url'=>array('index')),
	array('label'=>'Create ModeratorDocumentos', 'url'=>array('create')),
	array('label'=>'View ModeratorDocumentos', 'url'=>array('view', 'id'=>$model->idmoderatorDocumentos)),
	array('label'=>'Manage ModeratorDocumentos', 'url'=>array('admin')),
);
?>

<h1>Update ModeratorDocumentos <?php echo $model->idmoderatorDocumentos; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>