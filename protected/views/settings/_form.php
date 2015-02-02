<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'setting_key'); ?>
		<?php echo $form->textField($model,'setting_key',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'setting_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'setting_subkey'); ?>
		<?php echo $form->textField($model,'setting_subkey',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'setting_subkey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'setting_value'); ?>
		<?php echo $form->textField($model,'setting_value',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'setting_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->