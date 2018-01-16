<?php
/* @var $this SiniestrosController */
/* @var $model Siniestros */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <!--
	<div class="row">
		<?php //echo $form->label($model,'idsiniestros'); ?>
		<?php //echo $form->textField($model,'idsiniestros'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'codRama'); ?>
		<?php echo $form->textField($model,'codRama',array('size'=>45,'maxlength'=>45)); ?>
	</div>

        <div class="row">
		<?php echo $form->label($model,'codSiniestro'); ?>
		<?php echo $form->textField($model,'codSiniestro',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etiqueta'); ?>
		<?php echo $form->textField($model,'etiqueta',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestampCreacion'); ?>
                <?php //echo $form->textField($model,'timestampCreacion');
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Siniestros[timestampCreacion]',
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