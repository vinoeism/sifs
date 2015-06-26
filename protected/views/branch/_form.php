<?php
/* @var $this BranchController */
/* @var $model Branch */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branch-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_name'); ?>
		<?php echo $form->textField($model,'branch_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'branch_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_code'); ?>
		<?php echo $form->textField($model,'branch_code',array('size'=>7,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'branch_code'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'branch_location'); ?>
		<?php echo $form->textField($model,'branch_location',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'branch_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_registered_office'); ?>
		<?php echo $form->checkbox($model,'is_registered_office'); ?>
		<?php echo $form->error($model,'is_registered_office'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PAN_no'); ?>
		<?php echo $form->textField($model,'PAN_no',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'PAN_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ST_registration_no'); ?>
		<?php echo $form->textField($model,'ST_registration_no',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ST_registration_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->