<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

        <!--
	<div class="row">
		<?php //echo $form->labelEx($model,'id_documentos'); ?>
		<?php //echo $form->textField($model,'id_documentos'); ?>
		<?php //echo $form->error($model,'id_documentos'); ?>
	</div>
        -->

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

        <!--
	<div class="row">
		<?php //echo $form->labelEx($model,'Path'); ?>
		<?php //echo $form->textField($model,'Path',array('size'=>45,'maxlength'=>45)); ?>
		<?php //echo $form->error($model,'Path'); ?>
	</div>
        -->

	<div class="row">
		<?php echo $form->labelEx($model,'etiqueta'); ?>
		<?php echo $form->textField($model,'etiqueta',array('size'=>45,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'etiqueta'); ?>
	</div>

        <!--
	<div class="row">
		<?php //echo $form->labelEx($model,'idsiniestros'); ?>
		<?php //echo $form->textField($model,'idsiniestros'); ?>
		<?php //echo $form->error($model,'idsiniestros'); ?>
	</div>
        -->

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->