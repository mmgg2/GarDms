<?php
/* @var $this ConfigController */
/* @var $model Config */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idconfig'); ?>
		<?php echo $form->textField($model,'idconfig'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_host'); ?>
		<?php echo $form->textField($model,'correo_host',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_port'); ?>
		<?php echo $form->textField($model,'correo_port',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_username'); ?>
		<?php echo $form->textField($model,'correo_username',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_from'); ?>
		<?php echo $form->textField($model,'correo_from',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'correo_SMTPSecure'); ?>
		<?php echo $form->textField($model,'correo_SMTPSecure',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'db_host'); ?>
		<?php echo $form->textField($model,'db_host',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'db_name'); ?>
		<?php echo $form->textField($model,'db_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'db_username'); ?>
		<?php echo $form->textField($model,'db_username',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->