<?php
/* @var $this JobController */
/* @var $data Job */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REFNO')); ?>:</b>
	<?php echo CHtml::encode($data->REFNO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Client_REFNO')); ?>:</b>
	<?php echo CHtml::encode($data->Client_REFNO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('init_date')); ?>:</b>
	<?php echo CHtml::encode($data->init_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quote_id')); ?>:</b>
	<?php echo CHtml::encode($data->quote_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipper')); ?>:</b>
	<?php echo CHtml::encode($data->shippers->party_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('consignee')); ?>:</b>
	<?php echo CHtml::encode($data->consignee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent')); ?>:</b>
	<?php echo CHtml::encode($data->agent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b>
	<?php echo CHtml::encode($data->cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('packages')); ?>:</b>
	<?php echo CHtml::encode($data->packages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assessable_value')); ?>:</b>
	<?php echo CHtml::encode($data->assessable_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duty_value')); ?>:</b>
	<?php echo CHtml::encode($data->duty_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duty_date')); ?>:</b>
	<?php echo CHtml::encode($data->duty_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duty_mode')); ?>:</b>
	<?php echo CHtml::encode($data->duty_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mode')); ?>:</b>
	<?php echo CHtml::encode($data->mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terms')); ?>:</b>
	<?php echo CHtml::encode($data->terms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gross_weight')); ?>:</b>
	<?php echo CHtml::encode($data->gross_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gross_weight_unit')); ?>:</b>
	<?php echo CHtml::encode($data->gross_weight_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nett_weight')); ?>:</b>
	<?php echo CHtml::encode($data->nett_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nett_weight_unit')); ?>:</b>
	<?php echo CHtml::encode($data->nett_weight_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chargeable_weight')); ?>:</b>
	<?php echo CHtml::encode($data->chargeable_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chargeable_weight_unit')); ?>:</b>
	<?php echo CHtml::encode($data->chargeable_weight_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_references')); ?>:</b>
	<?php echo CHtml::encode($data->document_references); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origin')); ?>:</b>
	<?php echo CHtml::encode($data->origin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destination')); ?>:</b>
	<?php echo CHtml::encode($data->destination); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transhipment')); ?>:</b>
	<?php echo CHtml::encode($data->transhipment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carrier_name')); ?>:</b>
	<?php echo CHtml::encode($data->carrier_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voyage_no')); ?>:</b>
	<?php echo CHtml::encode($data->voyage_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pickup_date')); ?>:</b>
	<?php echo CHtml::encode($data->pickup_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stuffing_date')); ?>:</b>
	<?php echo CHtml::encode($data->stuffing_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BE_SB_no')); ?>:</b>
	<?php echo CHtml::encode($data->BE_SB_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BE_SB_date')); ?>:</b>
	<?php echo CHtml::encode($data->BE_SB_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bond_no')); ?>:</b>
	<?php echo CHtml::encode($data->bond_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bond_date')); ?>:</b>
	<?php echo CHtml::encode($data->bond_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bond_comments')); ?>:</b>
	<?php echo CHtml::encode($data->bond_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('onboard_date')); ?>:</b>
	<?php echo CHtml::encode($data->onboard_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transhipment_arrival_date')); ?>:</b>
	<?php echo CHtml::encode($data->transhipment_arrival_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transhipment_date')); ?>:</b>
	<?php echo CHtml::encode($data->transhipment_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival_date')); ?>:</b>
	<?php echo CHtml::encode($data->arrival_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cfs_id')); ?>:</b>
	<?php echo CHtml::encode($data->cfs_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contr_nos')); ?>:</b>
	<?php echo CHtml::encode($data->contr_nos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_nos')); ?>:</b>
	<?php echo CHtml::encode($data->truck_nos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enquiry_by')); ?>:</b>
	<?php echo CHtml::encode($data->enquiry_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('handled_by')); ?>:</b>
	<?php echo CHtml::encode($data->handled_by); ?>
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