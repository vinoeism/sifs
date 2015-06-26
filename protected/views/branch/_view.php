<?php
/* @var $this BranchController */
/* @var $data Branch */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_name')); ?>:</b>
	<?php echo CHtml::encode($data->branch_name); ?>
	<br />

       	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_code')); ?>:</b>
	<?php echo CHtml::encode($data->branch_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_location')); ?>:</b>
	<?php echo CHtml::encode($data->branch_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_registered_office')); ?>:</b>
	<?php echo CHtml::encode($data->is_registered_office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAN_no')); ?>:</b>
	<?php echo CHtml::encode($data->PAN_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ST_registration_no')); ?>:</b>
	<?php echo CHtml::encode($data->ST_registration_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<?php /*
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