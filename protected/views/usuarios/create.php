<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/*
$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Create',
);*/
/*
$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>

<h1>Nuevo Usuario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>