<?php
/* @var $this DocumentosController */
/* @var $data Documentos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_documentos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_documentos), array('view', 'id'=>$data->id_documentos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Path')); ?>:</b>
	<?php echo CHtml::encode($data->Path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etiqueta')); ?>:</b>
	<?php echo CHtml::encode($data->etiqueta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idsiniestros')); ?>:</b>
	<?php echo CHtml::encode($data->idsiniestros); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>