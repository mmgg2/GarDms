<?php
/* @var $this ModeratorDocumentosController */
/* @var $model ModeratorDocumentos */

/*$this->menu=array(
	array('label'=>'List ModeratorDocumentos', 'url'=>array('index')),
	array('label'=>'Create ModeratorDocumentos', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('moderator-documentos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Papelera de Documentos</h1>



<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php if($delete==true){?>
    <div style="background-color: red;width:900px;height:20px;text-align: center;"><font size="4"><b><?php echo($msj);?></b></font></div>
<?php } ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moderator-documentos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
	'columns'=>array(
		//'idmoderatorDocumentos',
		array(
		'name'=>'id_object',
		'header'=>'Identificador',
		),
		array(
		'name'=>'isSiniestro',
		'header'=>'Tipo',
		'filter' => array('Siniestro' => 'Siniestro', 'Documento' => 'Documento'),
		),
		array(
		'name'=>'username',
		'header'=>'Usuario',
		),
		array(
		'name'=>'create',
		'header'=>'Fecha',
		),
		array(
			'class'=>'CButtonColumn',
			'header' => 'Opciones',
            'template'=>'{delete}',
			'buttons'=>array
			(
				'delete' => array
				(
					'label'=>'Borrar elemento',
					//'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
					'url'=>'Yii::app()->createUrl("moderatorDocumentos/DeleteModeratorDocumentos",array("id"=>$data->idmoderatorDocumentos))',
					'click'=>'function(){return confirm("¿Está seguro que desea borrar este elemento?");}'
				),
			),
		),
	),
)); ?>
