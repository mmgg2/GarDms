<?php
/* @var $this SiniestrosController */
/* @var $data Siniestros */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idsiniestros')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idsiniestros), array('view', 'id'=>$data->idsiniestros)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codRama')); ?>:</b>
	<?php echo CHtml::encode($data->codRama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etiqueta')); ?>:</b>
	<?php echo CHtml::encode($data->etiqueta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codSiniestro')); ?>:</b>
	<?php echo CHtml::encode($data->codSiniestro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestampCreacion')); ?>:</b>
	<?php echo CHtml::encode($data->timestampCreacion); ?>
	<br />


</div>