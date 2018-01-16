<style type="text/css">

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
left: -1000px;
border: 1px dashed gray;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 10;
left: 60px; /*position where enlarged image should offset horizontally */

}

</style>



<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

/*
$this->breadcrumbs=array(
    'Documentos'=>array('index'),
    'Manage',
);*/

/*
$this->menu=array(
    array('label'=>'Lista de Documentos', 'url'=>array('index')),
    //array('label'=>'Create Documentos', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('documentos-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1><?php echo $desc?></h1>


<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form --><br><br>


 <?php if($delete==true){?>
    <div style="background-color: red;width:900px;height:20px;text-align: center;"><font size="4"><b><?php echo($msj);?></b></font></div><br>
<?php } ?>


<?php if($update==true){?>
    <div style="background-color: #088A08;width:900px;height:20px;text-align: center;"><font size="4"><b><?php echo($msj);?></b></font></div>
<?php } ?>


<div id="buttonPrinter" style="float:right; margin-right:-205px;">
<input type="button" onclick="javascript:printerDoc();" value="Imprimir documentos" class="button medium blue">

<input type="button" onclick="javascript:opensMailBox();" value="Enviar por mail" class="button medium blue">

<?php if(Yii::app()->user->categoria=="admin" or Yii::app()->user->categoria=="digitalizador"){ ?>
    <input type="button" onclick="javascript:updateDocumentSelected('<?php echo Yii::app()->request->getBaseUrl(true);?>');" value="Actualizar todos los documentos" class="button medium blue">
<?php } ?>

</div>
  <br><br>


<input type="hidden" id="idSiniestro" value="<?php echo $siniestro?>">
<input type="hidden" id="descSiniestro" value="<?php echo $desc?>">
<input type="hidden" id="documentos_page" value="<?php echo $documentos_page?>">

<div id="div_loading_1" style="display:none;"></div>

<?php
 if(Yii::app()->user->categoria=="admin" or  Yii::app()->user->categoria=="digitalizador"){
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'documentos-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'ajaxUpdate'=>false,
                'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
                'rowCssClassExpression'=>function($row,$data) use ($check_doc){
					          if(in_array($data->id_documentos,$check_doc,true)){
									$class="odd selected";
							   }
							   else{
								   if($data->id_documentos%2){
									  $class="odd";
								   }
								   else{
									 $class="even";
								   }
							   }
							return $class;
						},
                //'rowCssClassExpression'=>'($data->id_documentos=='.$idDocumento.')?"odd selected":(($data->id_documentos%2)?"odd":"even")',
                'columns'=>array(
                       array(
                        'name'=>'id_documentos',
                        'htmlOptions'=>array('style'=>'max-width:5px'),
                        ),
                       array(
                        'name'=>'nombre',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),
                        array(
                        'name'=>'descripcion',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),

                      /*
                        array(
                        'header'=>'Vista Previa',
                        'type'=>'raw',
                        'value'=> function($data){
                                $imageUrl=$data->Path;
                                if(!file_exists($data->Path)){
                                    $imageUrl='images/notdisponible.jpg';
                                }
                                return CHtml::link( CHtml::image($imageUrl,"image",array("width"=>70,"height"=>70,"onmouseover"=>"this.width=200;this.height=200;","onmouseout"=>"this.width=70;this.height=70;")), $imageUrl, array("rel"=>"lightbox[roadtrip]"));
                            },
                       'htmlOptions'=>array('style'=>'width:80px'),
                        ),*/
                        array(
                        'header'=>'Vista Previa',
                        'type'=>'raw',
                        'value'=>function($data){
                            $imageUrl=$data->Path;
                                if(!file_exists($data->Path)){
                                    $imageUrl='images/notdisponible.jpg';
                                }
                                return '<a class="thumbnail"  rel="lightbox[roadtrip]" href="'.$imageUrl.'"><img src="'.$imageUrl.'" width="70px" height="66px" border="0" /><span><img src="'.$imageUrl.'" width="300px" height="300px" /><br /></span></a>';
                        },
                        'htmlOptions'=>array('style'=>'width:80px'),
                        ),
                        //'etiqueta',
                        array(
                        'name'=>'etiqueta',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),
                        array(
                         'name'=>'timestampCreacion',
                        'header'=>'Fecha',
                        //'value'=>'date("d-m-Y H:i:s",strtotime($data->timestampCreacion))',
                        'value'=>'(isset($data->timestampCreacion))? date("d-m-Y H:i:s",strtotime($data->timestampCreacion)):""',
                        ),
                        //'idsiniestros',
                        array(
                                'class'=>'CButtonColumn',
                                'header' => 'Opciones',
                                //'template'=>'{view} {update} {delete}',
                                'template'=>'{view} {update} {delete}',
                                //'viewButtonOptions' => array("target" => "_blank"),
                                'buttons'=>array
                                (
                                    'view' => array
                                    (
                                        'label'=>'Abrir',
                                        //'url'=>"Yii::app()->request->baseUrl.'/images/doc1.jpg'",,
                                        'url'=> '"javascript:viewDoc(\"".$data->Path."\",$data->id_documentos,'.$siniestro.');"',
                                    ),
                                    'update' => array
                                    (
                                        'label'=>'Actualizar Documento',
                                        'url'=>'Yii::app()->createUrl("documentos/update", array("id"=>$data->id_documentos,"siniestro"=>'.$siniestro.',"desc_siniestro"=>"'.$desc.'","documentos_page"=>"'.$documentos_page.'"))',
                                    ),
                                    'delete' => array
                                    (
                                        'label'=>'Borrar Siniestro',
                                        //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                        'url'=>'Yii::app()->createUrl("documentos/DeleteDocumento", array("id"=>$data->id_documentos,"siniestro"=>'.$siniestro.',"desc_siniestro"=>"'.$desc.'"))',
                                        'click'=>'function(){return confirm("¿Está seguro que desea borrar este documentos?");}',
                                        'visible'=>'(($data->flagDelete=='.'""'.')?'.'true'.':'.'false'.')',
                                    ),

                                ),
                        ),
                        array(
                            'id' => 'selectedIds',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '2',
                            'header'=>'Selected',
                        ),
                ),
            'emptyText' => 'No se encontraron resultados',
            'summaryText' => 'Mostrando {start}-{end} de {count} registro(s).',
        ));
 }
 else{
      $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'documentos-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'ajaxUpdate'=>false,
                'htmlOptions'=>array('style'=>'word-wrap:break-word; width:920px;'),
                //'rowCssClassExpression'=>'($data->id_documentos=='.$idDocumento.')?"odd selected":(($data->id_documentos%2)?"odd":"even")',
                'columns'=>array(
                    array(
                        'name'=>'id_documentos',
                        'htmlOptions'=>array('style'=>'max-width:5px'),
                        ),
                       array(
                        'name'=>'nombre',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),
                        array(
                        'name'=>'descripcion',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),
                        //'Path',
                        /*array(
                        'header'=>'Vista Previa',
                        'type'=>'raw',
                        'value'=> function($data){
                                $imageUrl=$data->Path;
                                if(!file_exists($data->Path)){
                                    $imageUrl='images/notdisponible.jpg';
                                }
                                return CHtml::link( CHtml::image($imageUrl,"image",array("width"=>70,"height"=>70,"onmouseover"=>"this.width=200;this.height=200;","onmouseout"=>"this.width=70;this.height=70;")), $imageUrl, array("rel"=>"lightbox[roadtrip]"));
                            },
                       'htmlOptions'=>array('style'=>'width:80px'),
                        ),*/
                        array(
                        'header'=>'Vista Previa',
                        'type'=>'raw',
                        'value'=>function($data){
                            $imageUrl=$data->Path;
                                if(!file_exists($data->Path)){
                                    $imageUrl='images/notdisponible.jpg';
                                }
                                return '<a class="thumbnail"  rel="lightbox[roadtrip]" href="'.$imageUrl.'"><img src="'.$imageUrl.'" width="70px" height="66px" border="0" /><span><img src="'.$imageUrl.'" width="300px" height="300px" /><br /></span></a>';
                        },
                        'htmlOptions'=>array('style'=>'width:80px'),
                        ),
                        //'etiqueta',
                        array(
                        'name'=>'etiqueta',
                        'htmlOptions'=>array('style'=>'max-width:20px'),
                        ),
                        array(
                        'name'=>'timestampCreacion',
                        'header'=>'Fecha',
                        'value'=>'(isset($data->timestampCreacion))? date("d-m-Y H:i:s",strtotime($data->timestampCreacion)):""',
                        ),

                        //'idsiniestros',
                        array(
                            'class'=>'CButtonColumn',
                            'header' => 'Opciones',
                            //'template'=>'{view} {update} {delete}',
                            'template'=>'{view}',
                            //'viewButtonOptions' => array("target" => "_blank"),
                            'buttons'=>array
                            (
                                'view' => array
                                (
                                    'label'=>'Abrir',
                                    //'url'=>"Yii::app()->request->baseUrl.'/images/doc1.jpg'",,
                                    'url'=> '"javascript:viewDoc(\"".$data->Path."\",$data->id_documentos,'.$siniestro.');"',
                                    /*'url'=> function($data){
                                            $imageUrl1=$data->Path;
                                            if(!file_exists($data->Path)){
                                                $imageUrl1='images/notdisponible.jpg';
                                            }
                                            return 'javascript:viewDoc("'.$imageUrl1.'",'.$data->id_documentos.','.$siniestro.');';
                                        } */
                                ),
                            ),
                        ),
                        array(
                            'id' => 'selectedIds',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '2',
                            'header'=>'Selected',
                        ),
                ),
            'emptyText' => 'No se encontraron resultados',
            'summaryText' => 'Mostrando {start}-{end} de {count} registro(s).',
        ));
 }

?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Enviar por mail',
        'modal'=>true,
        'autoOpen'=>false,
         'width'=>'500',
    ),
));

?>


<div style="float:left;margin: 10px;">
    Destinarios:
    <select multiple id="select1" style="width: 450px;height: 80px;">
    <?php
    foreach ($arrDestinarios as $value) {
        if($value){
    ?>
    <option value="<?php echo $value ?>"><?php echo $value ?></option>
    <?php
        }}?>
    </select>
    <a href="#" id="add" style= "display: block;width: 200px;border: 1px solid #aaa;text-decoration: none;background-color: #fafafa;color: #123456;margin: 2px;clear:both;">Seleccionar &gt;&gt;</a>
</div>
<div style="float:left;text-align: center;margin: 10px;">
    <select multiple id="select2" style="width: 450px;height: 80px;"></select>
    <a href="#" id="remove"  style= "display: block;width: 200px;border: 1px solid #aaa;text-decoration: none;background-color: #fafafa;color: #123456;margin: 2px;clear:both;">&lt;&lt; Eliminar</a>
</div>

<INPUT TYPE="button" class="button medium blue" onclick="javascript:sendMail();" value="Enviar">

<div id="div_loading" style="display:none;">Enviando!!!!  <img src="images/ajax-loader.gif"></div>
 <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<script>

  $().ready(function() {
   $('#add').click(function() {
    return !$('#select1 option:selected').remove().appendTo('#select2');
   });
   $('#remove').click(function() {
    return !$('#select2 option:selected').remove().appendTo('#select1');
   });
  });




function viewDoc(path,doc,siniestro){

    var xhr = jQuery.ajax({
    url : '<?php echo Yii::app()->createUrl("documentos/LogViewImages") ?>',
    data: {id: doc,idSinietro:siniestro},
    type: "Post",
    cache: false,
    dataType: "json",
    success:function (data){
        window.open(path,'_blank');
    }
    });
}


function printerDoc(){
    //Toma los doc checkeados
    var docCheck = $.fn.yiiGridView.getChecked('documentos-grid','selectedIds');

    if (docCheck.length > 0 ){
		document.getElementById("div_loading_1").style.display="";
		document.getElementById("div_loading_1").innerHTML='<label style="color:red;">Enviando a imprimir!!!!</label><br><img src="images/ajax-loader.gif">';

        var xhr = jQuery.ajax({
        url : '<?php echo Yii::app()->createUrl("documentos/PrinterDoc") ?>',
        data: {check: docCheck},
        type: "Post",
        cache: false,
        dataType: "json",
        success:function (data){
			document.getElementById("div_loading_1").style.display="none";
             window.open(data['filePrinter'],'_blank');
        }
        });

    }
    else{
        alert("Por favor, seleccione un documento!!");
    }
}


function printerDocPlugin(images){
        var xhr = jQuery.ajax({
        url : '<?php echo Yii::app()->createUrl("documentos/PrinterDocPlugin") ?>',
        data: {dataPath: images},
        type: "Post",
        cache: false,
        dataType: "json",
        success:function (data){

            window.open(data['filePrinter'],'_blank');
        }
        })
}


function opensMailBox(){
    //Toma los doc checkeados
    var docCheck = $.fn.yiiGridView.getChecked('documentos-grid','selectedIds');

    if (docCheck.length > 0 ){
      $( "#mydialog" ).dialog( "open" );
    }
    else{
    alert("Por favor, seleccione un documento!!");
    }
}


function opensMailBoxPlugin(){
      $( "#mydialog" ).dialog( "open" );
}

function updateDocumentSelected(param){
    var url=param;
    var idSiniestro= document.getElementById("idSiniestro").value;
    var descSiniestro= document.getElementById("descSiniestro").value;
    var documentos_page=document.getElementById("documentos_page").value;

    var docCheck = $.fn.yiiGridView.getChecked('documentos-grid','selectedIds');
    if (docCheck.length > 0 ){
        window.location=url+"/index.php?r=documentos/UpdateDocumentSelected&idSiniestro="+idSiniestro+"&descSiniestro="+descSiniestro+"&docCheck="+docCheck+"&documentos_page="+documentos_page;
    }
    else{
        alert("Por favor, seleccione un documento!!");
    }

}



function sendMail(){
    //Toma los doc checkeados
    var docCheck = $.fn.yiiGridView.getChecked('documentos-grid','selectedIds');
    var arrDestinatarios= document.getElementById("select2");
    var cadena="";
    var destSplit;
    for (var i = 0; i < arrDestinatarios.length; i++)
    {
        destSplit=arrDestinatarios[i].value.split("\n");
        cadena += destSplit[0];
    }

    document.getElementById("div_loading").style.display="";

    var xhr = jQuery.ajax({
    url : '<?php echo Yii::app()->createUrl("documentos/SendMail") ?>',
    data: {check: docCheck, arrDestinatarios:cadena},
    type: "Post",
    cache: false,
    dataType: "json",
    success:function (data){
        alert(data['description']);
        document.getElementById("div_loading").style.display="none";
        $( "#mydialog" ).dialog( "close" );
    }
    });
}

</script>
