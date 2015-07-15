<?php
/* @var $this PartyController */
/* @var $model Party */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'party-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'party_name'); ?>
		<?php echo $form->textField($model,'party_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'party_name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'party_type'); ?>
		<?php echo $form->dropDownList($model,'party_type',$model->getPartyTypes()); ?>
		<?php echo $form->error($model,'party_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_code'); ?>
		<?php echo $form->textField($model,'short_code',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'short_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_blacklisted'); ?>
		<?php echo $form->checkBox($model,'is_blacklisted'); ?>
		<?php echo $form->error($model,'is_blacklisted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pan_no'); ?>
		<?php echo $form->textField($model,'pan_no',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'pan_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_tax_no'); ?>
		<?php echo $form->textField($model,'service_tax_no',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'service_tax_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credit_days'); ?>
		<?php echo $form->dropDownList($model,'credit_days',$model->getTermsOfPaymentTypes(), array('prompt'=>'-- Select Terms of Payment --',)); ?>
		<?php echo $form->error($model,'credit_days'); ?>
	</div>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'debit_days'); ?>
		<?php //echo $form->textField($model,'debit_days'); ?>
		<?php //echo $form->error($model,'debit_days'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->