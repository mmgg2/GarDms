<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'siniestros-form',
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'codRama'); ?>
		<?php //echo $form->textField($model,'codRama',array('size'=>45,'maxlength'=>500)); ?>
		<?php //echo $form->error($model,'codRama'); ?>
	</div>
-->

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'etiqueta'); ?>
		<?php echo $form->textField($model,'etiqueta',array('size'=>45,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'etiqueta'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'codSiniestro'); ?>
		<?php //echo $form->textField($model,'codSiniestro',array('size'=>45,'maxlength'=>500)); ?>
		<?php //echo $form->error($model,'codSiniestro'); ?>
	</div>
-->

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'timestampCreacion'); ?>
		<?php //echo $form->textField($model,'timestampCreacion'); ?>
		<?php //echo $form->error($model,'timestampCreacion'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->