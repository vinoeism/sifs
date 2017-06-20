<?php
/* @var $this TripController */
/* @var $model Trip */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_regn_no'); ?>
		<?php echo $form->textField($model,'vehicle_regn_no',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_type'); ?>
		<?php echo $form->textField($model,'vehicle_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_id'); ?>
		<?php echo $form->textField($model,'vehicle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_id'); ?>
		<?php echo $form->textField($model,'employee_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trip_type'); ?>
		<?php echo $form->textField($model,'trip_type',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trip_date_start'); ?>
		<?php echo $form->textField($model,'trip_date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trip_date_end'); ?>
		<?php echo $form->textField($model,'trip_date_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driver_name'); ?>
		<?php echo $form->textField($model,'driver_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driver_phone'); ?>
		<?php echo $form->textField($model,'driver_phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'in_time'); ?>
		<?php echo $form->textField($model,'in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'out_time'); ?>
		<?php echo $form->textField($model,'out_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_odo'); ?>
		<?php echo $form->textField($model,'start_odo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_odo'); ?>
		<?php echo $form->textField($model,'end_odo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'from_location'); ?>
		<?php echo $form->textField($model,'from_location',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'from_location_id'); ?>
		<?php echo $form->textField($model,'from_location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_location'); ?>
		<?php echo $form->textField($model,'to_location',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_location_id'); ?>
		<?php echo $form->textField($model,'to_location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transporter_id'); ?>
		<?php echo $form->textField($model,'transporter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'package_id'); ?>
		<?php echo $form->textField($model,'package_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booked_by'); ?>
		<?php echo $form->textField($model,'booked_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booked_on'); ?>
		<?php echo $form->textField($model,'booked_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->