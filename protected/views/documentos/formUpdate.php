
<?php

$this->menu=array(
    //array('label'=>'List Documentos', 'url'=>array('index')),
    //array('label'=>'Create Documentos', 'url'=>array('create')),
    //array('label'=>'View Documentos', 'url'=>array('view', 'id'=>$model->id_documentos)),
    array('label'=>'Gestión de Documentos', 'url'=>array('admin&idSiniestro='.$siniestro.'&desc='.$desc_siniestro)),
);
?>

<h1>Actualizar Documentos Seleccionados</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'documentos-form',
    'enableAjaxValidation'=>false,
)); ?>

    <input type="hidden" id="docCheckUpdate" name="docCheckUpdate" value="<?php echo $docCheck?>">
    <input type="hidden" id="documentos_page" name="documentos_page" value="<?php echo $documentos_page?>">
  

    <div class="row">
            <label for="descripcion">Descripción</label> 
            <input type="text" name="descripcion" id="descripcion">
            <!--<input type="checkbox" name="option1" id="option1" onclick="selectDisable('option1','descripcion');"> Habilitar<br>--> 
    </div>

    <div class="row">
            <label for="etiqueta">Etiqueta</label> 
            <input type="text" name="etiqueta" id="etiqueta">
            <!--<input type="checkbox" name="option2" id="option2" onclick="selectDisable('option2','etiqueta');"> Habilitar<br> -->
    </div>

  
    <div class="row buttons">
        <?php echo CHtml::submitButton('Guardar'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    /*
 function selectDisable(enabled,field){
     if(document.getElementById(enabled).checked){
        document.getElementById(field).disabled=false;
     }
     else{
        document.getElementById(field).disabled=true; 
     }
 } 
 */  
 </script>
