<?php
/* @var $this TripController */
/* @var $data Trip */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_regn_no')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_regn_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_type')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_id')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trip_type')); ?>:</b>
	<?php echo CHtml::encode($data->trip_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trip_date_start')); ?>:</b>
	<?php echo CHtml::encode($data->trip_date_start); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('trip_date_end')); ?>:</b>
	<?php echo CHtml::encode($data->trip_date_end); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_name')); ?>:</b>
	<?php echo CHtml::encode($data->driver_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_phone')); ?>:</b>
	<?php echo CHtml::encode($data->driver_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('in_time')); ?>:</b>
	<?php echo CHtml::encode($data->in_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('out_time')); ?>:</b>
	<?php echo CHtml::encode($data->out_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_odo')); ?>:</b>
	<?php echo CHtml::encode($data->start_odo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_odo')); ?>:</b>
	<?php echo CHtml::encode($data->end_odo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_location')); ?>:</b>
	<?php echo CHtml::encode($data->from_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_location_id')); ?>:</b>
	<?php echo CHtml::encode($data->from_location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_location')); ?>:</b>
	<?php echo CHtml::encode($data->to_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_location_id')); ?>:</b>
	<?php echo CHtml::encode($data->to_location_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transporter_id')); ?>:</b>
	<?php echo CHtml::encode($data->transporter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('package_id')); ?>:</b>
	<?php echo CHtml::encode($data->package_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booked_by')); ?>:</b>
	<?php echo CHtml::encode($data->booked_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booked_on')); ?>:</b>
	<?php echo CHtml::encode($data->booked_on); ?>
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