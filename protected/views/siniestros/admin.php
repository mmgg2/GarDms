<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */

/*$this->breadcrumbs=array(
    'Siniestros'=>array('index'),
    'Manage',
);*/

/*$this->menu=array(
    array('label'=>'List Siniestros', 'url'=>array('index')),
    array('label'=>'Create Siniestros', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('siniestros-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1>Siniestros</h1>



<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if($delete==true){?>
    <div style="background-color: red;width:900px;height:20px;text-align: center;"><font size="4"><b><?php echo($msj);?></b></font></div>
<?php } ?>


<?php if($update==true){?>
    <div style="background-color: #088A08;width:900px;height:20px;text-align: center;"><font size="4"><b><?php echo($msj);?></b></font></div>
<?php } ?>


<input type="hidden" id="Siniestros_page" value="<?php echo $Siniestros_page?>">

<?php 

 if(Yii::app()->user->categoria=="admin" or Yii::app()->user->categoria=="digitalizador"){
     
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'siniestros-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'ajaxUpdate'=>false,
                'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
                'rowCssClassExpression'=>'($data->idsiniestros=='.$idsiniestros.')?"odd selected":(($data->idsiniestros%2)?"odd":"even")',
                'columns'=>array(
                    //'idsiniestros',
                    /*array(
                        'name'=>'idsiniestros',
                        'htmlOptions'=>array('style'=>'max-width:5px'),
                        ),*/
                        array(
                        'header'=>'Identificador',
                        'name'=>'idsiniestros',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->idsiniestros,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'width:10px'),
                        ),
                        array(                  
                        'header'=>'Rama',
                        'name'=>'codRama',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->codRama,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'width:80px'),
                        ),
                        array(
                        'header'=>'Código Siniestro',
                        'name'=>'codSiniestro',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->codSiniestro,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[codSiniestro]",""),
                        ),
                        array(
                        'header'=>'Descripcion',
                        'name'=>'descripcion',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->descripcion,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[descripcion]",""),
                        ),
                      array(
                        'header'=>'Etiqueta',
                        'name'=>'etiqueta',
                        'type'=>'html', 
                        'value'=>'CHtml::link($data->etiqueta,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[etiqueta]",""),
                        ),
                        array(
                        'header'=>'Fecha',
                        'name'=>'timestampCreacion',
                        'type'=>'html', 
                        'value'=>function($data){
                                $timestampCreacion=$data->timestampCreacion;
                                if($timestampCreacion <> ""){
                                return CHtml::link(date("d-m-Y H:i:s",strtotime($data->timestampCreacion)),array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro));
                                }
                            }, 
                        ),
                        array(
                                'class'=>'CButtonColumn',
                                'header' => 'Opciones',
                                'template'=>'{view} {update} {delete}',
                                'buttons'=>array
                                (
                                'view' => array
                                (
                                    'label'=>'Ver Documentos',
                                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                    'url'=>'Yii::app()->createUrl("documentos/admin", array("idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                                ),
                                'update' => array
                                (
                                    'label'=>'Actualizar Documento',
                                    'url'=>'Yii::app()->createUrl("siniestros/update", array("id"=>$data->idsiniestros,"Siniestros_page"=>"'.$Siniestros_page.'"))',
                                ),
                               'delete' => array
                                (
                                    'label'=>'Borrar Siniestro',
                                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                    'url'=>'Yii::app()->createUrl("siniestros/DeleteSiniestro", array("id"=>$data->idsiniestros))',
                                    'click'=>'function(){return confirm("¿Está seguro que desea borrar el siniestro y todos los documentos asociados?");}',
									'visible'=>'(($data->flagDelete=='.'""'.')?'.'true'.':'.'false'.')',
                                ),

                                ),
                        ),
                ),
                'emptyText' => 'No se encontraron resultados',
                'summaryText' => 'Mostrando {start}-{end} de {count} registro(s).',
        ));
 }    
 else{
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'siniestros-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
            'columns'=>array(
                       array(
                        'header'=>'Identificador',
                        'name'=>'idsiniestros',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->idsiniestros,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'width:10px'),
                        //'filter' => CHtml::textField("Siniestros[idsiniestros]",""),
                        ),
                        array(                  
                        'header'=>'Rama',
                        'name'=>'codRama',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->codRama,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'width:80px'),
                        //'filter' => CHtml::textField("Siniestros[codRama]",""),
                        ),
                        array(
                        'header'=>'Código Siniestro',
                        'name'=>'codSiniestro',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->codSiniestro,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[codSiniestro]",""),
                        ),
                        array(
                        'header'=>'Descripcion',
                        'name'=>'descripcion',
                        'type'=>'raw', 
                        'value'=>'CHtml::link($data->descripcion,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[descripcion]",""),
                        ),
                        array(
                        'header'=>'Etiqueta',
                        'name'=>'etiqueta',
                        'type'=>'html', 
                        'value'=>'CHtml::link($data->etiqueta,array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        //'filter' => CHtml::textField("Siniestros[etiqueta]",""),
                        ),
                        array(
                        'header'=>'Fecha',
                        'name'=>'timestampCreacion',
                        'type'=>'html', 
                        'value'=>function($data){
                                $timestampCreacion=$data->timestampCreacion;
                                if($timestampCreacion <> ""){
                                return CHtml::link(date("d-m-Y H:i:s",strtotime($data->timestampCreacion)),array("documentos/admin","idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro));
                                }
                            }, 
                        ),
                        array(
                            'class'=>'CButtonColumn',
                            'header' => 'Opciones',
                            'template'=>'{view}',
                            'buttons'=>array
                            (
                                
                            'view' => array
                            (
                                'label'=>'Ver Documentos',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("documentos/admin", array("idSiniestro"=>$data->idsiniestros,"desc"=>"Siniestro: ".$data->codRama."-".$data->codSiniestro))',
                            ),

                            ),
                    ),
            ),
            'emptyText' => 'No se encontraron resultados',
            'summaryText' => 'Mostrando {start}-{end} de {count} registro(s).',
        )); 
    }

?>



