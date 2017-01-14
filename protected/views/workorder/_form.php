<?php
/* @var $this WorkorderController */
/* @var $model Workorder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workorder-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'wo_date'); ?>
		<?php echo $form->textField($model,'wo_date'); ?>
		<?php echo $form->error($model,'wo_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
		<?php echo $form->error($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_id'); ?>
		<?php echo $form->textField($model,'trip_id'); ?>
		<?php echo $form->error($model,'trip_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transporter_id'); ?>
		<?php echo $form->textField($model,'transporter_id'); ?>
		<?php echo $form->error($model,'transporter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_type'); ?>
		<?php echo $form->textField($model,'trip_type',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'trip_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_date_start'); ?>
		<?php echo $form->textField($model,'trip_date_start'); ?>
		<?php echo $form->error($model,'trip_date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_date_end'); ?>
		<?php echo $form->textField($model,'trip_date_end'); ?>
		<?php echo $form->error($model,'trip_date_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'in_time'); ?>
		<?php echo $form->textField($model,'in_time'); ?>
		<?php echo $form->error($model,'in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'out_time'); ?>
		<?php echo $form->textField($model,'out_time'); ?>
		<?php echo $form->error($model,'out_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_location'); ?>
		<?php echo $form->textField($model,'from_location',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'from_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_location_id'); ?>
		<?php echo $form->textField($model,'from_location_id'); ?>
		<?php echo $form->error($model,'from_location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_location'); ?>
		<?php echo $form->textField($model,'to_location',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'to_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_location_id'); ?>
		<?php echo $form->textField($model,'to_location_id'); ?>
		<?php echo $form->error($model,'to_location_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
		<?php echo $form->error($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
		<?php echo $form->error($model,'updated_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->