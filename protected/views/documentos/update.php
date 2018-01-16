<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

/*
$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	$model->id_documentos=>array('view','id'=>$model->id_documentos),
	'Update',
);*/

$this->menu=array(
	//array('label'=>'List Documentos', 'url'=>array('index')),
	//array('label'=>'Create Documentos', 'url'=>array('create')),
	//array('label'=>'View Documentos', 'url'=>array('view', 'id'=>$model->id_documentos)),
	array('label'=>'Gestión de Documentos', 'url'=>array('admin&idSiniestro='.$siniestro.'&desc='.$desc_siniestro)),
);

?>

<h1>Actualizar Documento <?php echo $model->nombre; ?></h1>


<?php echo $this->renderPartial('_form', array('model'=>$model,'idSiniestro'=>$siniestro,'desc'=>$desc_siniestro)); ?>