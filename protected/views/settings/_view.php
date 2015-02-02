<?php
/* @var $this SettingsController */
/* @var $data Settings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_key')); ?>:</b>
	<?php echo CHtml::encode($data->setting_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_subkey')); ?>:</b>
	<?php echo CHtml::encode($data->setting_subkey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_value')); ?>:</b>
	<?php echo CHtml::encode($data->setting_value); ?>
	<br />


</div>