<?php
/* @var $this ModeratorDocumentosController */
/* @var $model ModeratorDocumentos */

$this->breadcrumbs=array(
	'Moderator Documentoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModeratorDocumentos', 'url'=>array('index')),
	array('label'=>'Manage ModeratorDocumentos', 'url'=>array('admin')),
);
?>

<h1>Create ModeratorDocumentos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>