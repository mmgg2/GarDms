<?php
/* @var $this ConfigController */
/* @var $data Config */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idconfig')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idconfig), array('view', 'id'=>$data->idconfig)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_host')); ?>:</b>
	<?php echo CHtml::encode($data->correo_host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_port')); ?>:</b>
	<?php echo CHtml::encode($data->correo_port); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_username')); ?>:</b>
	<?php echo CHtml::encode($data->correo_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_password')); ?>:</b>
	<?php echo CHtml::encode($data->correo_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_from')); ?>:</b>
	<?php echo CHtml::encode($data->correo_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_SMTPSecure')); ?>:</b>
	<?php echo CHtml::encode($data->correo_SMTPSecure); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('db_host')); ?>:</b>
	<?php echo CHtml::encode($data->db_host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('db_name')); ?>:</b>
	<?php echo CHtml::encode($data->db_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('db_username')); ?>:</b>
	<?php echo CHtml::encode($data->db_username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('db_password')); ?>:</b>
	<?php echo CHtml::encode($data->db_password); ?>
	<br />

	*/ ?>

</div>