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

        <p><i>Kindly comment on why the voucher was rejected.</i></p>
        
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rejection_comments'); ?>
		<?php echo $form->textArea($model,'rejection_comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'rejection_comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->dropDownList($model,'priority',$model->getPriorityOptions()); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Reject Voucher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->