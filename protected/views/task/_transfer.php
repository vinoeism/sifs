<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'transferred_to'); ?>
		<?php echo $form->textField($model,'transferred_to'); ?>
		<?php echo $form->error($model,'transferred_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transfer_reason'); ?>
		<?php echo $form->textArea($model,'transfer_reason',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'transfer_reason'); ?>
	</div>

        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->