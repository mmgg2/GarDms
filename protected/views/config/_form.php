<?php
/* @var $this ConfigController */
/* @var $model Config */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_host'); ?>
		<?php echo $form->textField($model,'correo_host',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_host'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_port'); ?>
		<?php echo $form->textField($model,'correo_port',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_port'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_username'); ?>
		<?php echo $form->textField($model,'correo_username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_password'); ?>
		<?php echo $form->textField($model,'correo_password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_from'); ?>
		<?php echo $form->textField($model,'correo_from',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'correo_SMTPSecure'); ?>
		<?php echo $form->textField($model,'correo_SMTPSecure',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'correo_SMTPSecure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_host'); ?>
		<?php echo $form->textField($model,'db_host',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'db_host'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_name'); ?>
		<?php echo $form->textField($model,'db_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'db_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_username'); ?>
		<?php echo $form->textField($model,'db_username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'db_username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'db_password'); ?>
		<?php echo $form->textField($model,'db_password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'db_password'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
