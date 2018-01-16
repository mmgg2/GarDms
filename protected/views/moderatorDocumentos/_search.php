<?php
/* @var $this ModeratorDocumentosController */
/* @var $model ModeratorDocumentos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<!--<div class="row">
		<?php //echo $form->label($model,'idmoderatorDocumentos'); ?>
		<?php //echo $form->textField($model,'idmoderatorDocumentos'); ?>
	</div>-->

	<!--<div class="row">
		<?php //echo $form->label($model,'id_object'); ?>
		<?php //echo $form->textField($model,'id_object',array('size'=>45,'maxlength'=>45)); ?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'isSiniestro'); ?>
		<?php echo $form->textField($model,'isSiniestro',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestampCreacion'); ?>
		<?php echo $form->textField($model,'timestampCreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
