<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

/*
$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);*/
/*
$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'View Usuarios', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);
*/
?>

<h1>Actualizar Usuario <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>