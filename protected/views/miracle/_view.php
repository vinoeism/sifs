<?php
/* @var $this MiracleController */
/* @var $data Miracle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miracle_date')); ?>:</b>
	<?php echo CHtml::encode($data->miracle_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miracle_type')); ?>:</b>
	<?php echo CHtml::encode($data->miracle_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recepient')); ?>:</b>
	<?php echo CHtml::encode($data->recepient); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prayer_request')); ?>:</b>
	<?php echo CHtml::encode($data->prayer_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('warriors')); ?>:</b>
	<?php echo CHtml::encode($data->warriors); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testimony')); ?>:</b>
	<?php echo CHtml::encode($data->testimony); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on); ?>
	<br />

	*/ ?>

</div>