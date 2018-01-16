<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <!--
	<div class="row">
		<?php //echo $form->label($model,'id_documentos'); ?>
		<?php //echo $form->textField($model,'id_documentos'); ?>
	</div>
    -->
        <div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
	</div>

    <!--
	<div class="row">
		<?php //echo $form->label($model,'Path'); ?>
		<?php //echo $form->textField($model,'Path',array('size'=>45,'maxlength'=>45)); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'etiqueta'); ?>
		<?php echo $form->textField($model,'etiqueta',array('size'=>45,'maxlength'=>45)); ?>
	</div>

     <!--
	<div class="row">
		<?php //echo $form->label($model,'idsiniestros'); ?>
		<?php //echo $form->textField($model,'idsiniestros'); ?>
	</div>
       -->
        <div class="row">
		<?php echo $form->label($model,'timestampCreacion'); ?>
		<?php //echo $form->textField($model,'timestampCreacion');
                
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Documentos[timestampCreacion]',
                     'language' => 'es',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                    ),
                    'htmlOptions'=>array(
                    'style'=>'height:20px;'
                    ),
                    ));
               
                ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->