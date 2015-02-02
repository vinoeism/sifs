<?php
/* @var $this AddressController */
/* @var $model Address */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'address-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
                <?php if ($model->isNewRecord) {?>
		<?php echo $form->dropDownlist($model,'type',$model->getAddressTypes()); ?>
                <?php } else { ?>
		<?php echo $form->dropDownlist($model,'type',$model->getAddressTypes(),array('disabled'=>'true')); ?>
                <?php } ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line_1'); ?>
		<?php echo $form->textField($model,'line_1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'line_2'); ?>
		<?php echo $form->textField($model,'line_2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->textField($model,'district',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pincode'); ?>
		<?php echo $form->textField($model,'pincode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pincode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'landline_number'); ?>
		<?php echo $form->textField($model,'landline_number',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'landline_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax_number'); ?>
		<?php echo $form->textField($model,'fax_number',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'fax_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_1'); ?>
		<?php echo $form->textField($model,'contact_1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_1_designation'); ?>
		<?php echo $form->textField($model,'contact_1_designation',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_1_designation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_1_phone'); ?>
		<?php echo $form->textField($model,'contact_1_phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_1_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_1_email'); ?>
		<?php echo $form->textField($model,'contact_1_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_1_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_2'); ?>
		<?php echo $form->textField($model,'contact_2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_2_designation'); ?>
		<?php echo $form->textField($model,'contact_2_designation',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_2_designation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_2_phone'); ?>
		<?php echo $form->textField($model,'contact_2_phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_2_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_2_email'); ?>
		<?php echo $form->textField($model,'contact_2_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'contact_2_email'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->