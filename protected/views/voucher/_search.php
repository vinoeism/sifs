<?php
/* @var $this VoucherController */
/* @var $model Voucher */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>



	<div class="row">
		<?php echo $form->label($model,'voucher_date'); ?>
		<?php echo $form->textField($model,'voucher_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_type'); ?>
		<?php echo $form->textField($model,'voucher_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bill_id'); ?>
		<?php echo $form->textField($model,'bill_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_id'); ?>
		<?php echo $form->textField($model,'job_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_id'); ?>
		<?php echo $form->textField($model,'employee_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_id'); ?>
		<?php echo $form->textField($model,'vehicle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asset_id'); ?>
		<?php echo $form->textField($model,'asset_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_tax_1'); ?>
		<?php echo $form->textField($model,'total_tax_1',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_tax_2'); ?>
		<?php echo $form->textField($model,'total_tax_2',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_amount'); ?>
		<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'towards'); ?>
		<?php echo $form->textField($model,'towards',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('size'=>60,'maxlength'=>300)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'pay_to'); ?>
		<?php echo $form->textField($model,'pay_to',array('size'=>60,'maxlength'=>50)); ?>
	</div>
    
    	<div class="row">
		<?php echo $form->label($model,'due_on'); ?>
		<?php echo $form->textField($model,'due_on',array('size'=>60,'maxlength'=>50)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'passed_by'); ?>
		<?php echo $form->textField($model,'passed_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passed_on'); ?>
		<?php echo $form->textField($model,'passed_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'passed_comments'); ?>
		<?php echo $form->textField($model,'passed_comments',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approved_by'); ?>
		<?php echo $form->textField($model,'approved_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approved_on'); ?>
		<?php echo $form->textField($model,'approved_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approval_comments'); ?>
		<?php echo $form->textField($model,'approval_comments',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'priority'); ?>
		<?php echo $form->textField($model,'priority',array('size'=>10,'maxlength'=>10)); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->