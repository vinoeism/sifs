<?php
/* @var $this JobController */
/* @var $model Job */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'packages'); ?>
		<?php echo $form->textField($model,'packages',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'packages'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gross_weight'); ?>
		<?php echo $form->textField($model,'gross_weight'); ?>
		<?php echo $form->dropDownList($model,'gross_weight_unit',$model->getUnitsOptions()); ?>            
		<?php echo $form->error($model,'gross_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nett_weight'); ?>
		<?php echo $form->textField($model,'nett_weight'); ?>
		<?php echo $form->dropDownList($model,'nett_weight_unit',$model->getUnitsOptions()); ?>
		<?php echo $form->error($model,'nett_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chargeable_weight'); ?>
		<?php echo $form->textField($model,'chargeable_weight'); ?>
                <?php echo $form->dropDownList($model,'chargeable_weight_unit',$model->getUnitsOptions()); ?>
                <?php echo $form->error($model,'chargeable_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->