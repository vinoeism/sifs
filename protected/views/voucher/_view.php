<?php
/* @var $this VoucherController */
/* @var $data Voucher */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_date')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_type')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_id')); ?>:</b>
	<?php echo CHtml::encode($data->bill_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_id')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asset_id')); ?>:</b>
	<?php echo CHtml::encode($data->asset_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_serv_tax')); ?>:</b>
	<?php echo CHtml::encode($data->total_serv_tax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_edu_cess')); ?>:</b>
	<?php echo CHtml::encode($data->total_edu_cess); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_sur_edu_cess')); ?>:</b>
	<?php echo CHtml::encode($data->total_sur_edu_cess); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_amount')); ?>:</b>
	<?php echo CHtml::encode($data->total_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('towards')); ?>:</b>
	<?php echo CHtml::encode($data->towards); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passed_by')); ?>:</b>
	<?php echo CHtml::encode($data->passed_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passed_on')); ?>:</b>
	<?php echo CHtml::encode($data->passed_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passed_amount')); ?>:</b>
	<?php echo CHtml::encode($data->passed_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passed_comments')); ?>:</b>
	<?php echo CHtml::encode($data->passed_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approved_by')); ?>:</b>
	<?php echo CHtml::encode($data->approved_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approved_on')); ?>:</b>
	<?php echo CHtml::encode($data->approved_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approved_amount')); ?>:</b>
	<?php echo CHtml::encode($data->approved_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_comments')); ?>:</b>
	<?php echo CHtml::encode($data->approval_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
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