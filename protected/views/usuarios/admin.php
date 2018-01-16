<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

/*
$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	'Manage',
);*/

$this->menu=array(
	//array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Nuevo Usuario', 'url'=>array('create')),
        array('label'=>'Bajar logs de Usuarios', 'url'=>'', 'linkOptions'=>array('onclick'=>'javascript: window.open("Logger/loggerxxxx.log");','style' => 'cursor:pointer;')),
        array('label'=>'Configuraciones', 'url'=>array('config/view&id=1')),
        array('label'=>'Borrar cache', 'url'=>'', 'linkOptions'=>array('onclick'=>'javascript: deleteCaching();','style' => 'cursor:pointer;')),
        array('label'=>'Papelera de reciclaje ('.$countModeratorDocumentos.')', 'url'=>array('ModeratorDocumentos/admin'))
        );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuarios-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestión de Usuarios</h1>

<p>
</p><br><br><br>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
	'columns'=>array(
		//'id',
                array(
                'name'=>'username',
                'htmlOptions'=>array('style'=>'max-width:20px'),
                ),
                array(
                'name'=>'name',
                'htmlOptions'=>array('style'=>'max-width:20px'),
                ),
                array(
                'name'=>'lastName',
                'htmlOptions'=>array('style'=>'max-width:20px'),
                ),
		//'password',
               array(
                'name'=>'email',
                'htmlOptions'=>array('style'=>'max-width:20px'),
                ),
		//'isAdmin',
                 array(
                'name' => 'categoria',
                'filter' => array("admin" => "admin","usuario" => "usuario","digitalizador" => "digitalizador"),
                ),
		//'habilitado',
                array(
                'name' => 'habilitado',
                'filter' => array('SI' => 'SI', 'NO' => 'NO'),
                ),
                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Opciones',
                    'template'=>'{update} {delete}',
                 ),
	),
)); ?>

<script>
function deleteCaching(){
	var xhr = jQuery.ajax({
	url : '<?php echo Yii::app()->createUrl("config/deleteCaching") ?>',
	data: {},
	type: "Post",
	cache: false,
	dataType: "json",
	success:function (data){
	alert(data['description']);
	//document.getElementById("div_loading").style.display="none";
	}
	});
}

</script>
