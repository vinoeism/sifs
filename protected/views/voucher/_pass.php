<?php
/* @var $this VoucherController */
/* @var $model Voucher */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'voucher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'passed_comments'); ?>
		<?php echo $form->textArea($model,'passed_comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'passed_comments'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->dropDownList($model,'priority',$model->getPriorityOptions()); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Pass Voucher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->