<?php
/* @var $this VehicleController */
/* @var $model Vehicle */
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
		<?php echo $form->label($model,'regn_no'); ?>
		<?php echo $form->textField($model,'regn_no',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch_id'); ?>
		<?php echo $form->textField($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'manufacturer_id'); ?>
		<?php echo $form->textField($model,'manufacturer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_type'); ?>
		<?php echo $form->textField($model,'vehicle_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rc_no'); ?>
		<?php echo $form->textField($model,'rc_no',array('size'=>50,'maxlength'=>50)); ?>
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

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->