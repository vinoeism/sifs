<?php
/* @var $this MiracleController */
/* @var $model Miracle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'miracle-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'miracle_type'); ?>
		<?php echo $form->dropDownList($model,'miracle_type',$model->getMiracleTypes()); ?>
		<?php echo $form->error($model,'miracle_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recepient'); ?> <i>(Please separate multiple recepients using comma)</i><br/>
		<?php echo $form->textField($model,'recepient',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'recepient'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prayer_request'); ?>
		<?php echo $form->textArea($model,'prayer_request',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'prayer_request'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->