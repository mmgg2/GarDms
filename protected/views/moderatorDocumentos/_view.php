<?php
/* @var $this ModeratorDocumentosController */
/* @var $data ModeratorDocumentos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmoderatorDocumentos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idmoderatorDocumentos), array('view', 'id'=>$data->idmoderatorDocumentos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_object')); ?>:</b>
	<?php echo CHtml::encode($data->id_object); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isSiniestro')); ?>:</b>
	<?php echo CHtml::encode($data->isSiniestro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create')); ?>:</b>
	<?php echo CHtml::encode($data->create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />


</div>