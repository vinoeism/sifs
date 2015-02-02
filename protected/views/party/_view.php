<?php
/* @var $this PartyController */
/* @var $data Party */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('party_name')); ?>:</b>
	<?php echo CHtml::encode($data->party_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_blacklisted')); ?>:</b>
	<?php echo CHtml::encode($data->is_blacklisted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pan_no')); ?>:</b>
	<?php echo CHtml::encode($data->pan_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_tax_no')); ?>:</b>
	<?php echo CHtml::encode($data->service_tax_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_days')); ?>:</b>
	<?php echo CHtml::encode($data->credit_days); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('debit_days')); ?>:</b>
	<?php echo CHtml::encode($data->debit_days); ?>
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