<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'REFNO'); ?>
		<?php echo $form->textField($model,'REFNO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'REFNO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_date'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'invoice_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'value'=>CTimestamp::formatDate('Y/m/d')
                        ),
                    ));
                ?>  		
                <?php echo $form->error($model,'invoice_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'party_id'); ?>
		<?php echo $form->dropDownList($model,'party_id',$model->getPartyOptions($model->job_id)); ?>
		<?php echo $form->error($model,'party_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_terms'); ?>
		<?php echo $form->textArea($model,'invoice_terms',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'invoice_terms'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkbox($model,'is_active',array('checked'=>'checked')); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>
<!--	<div class="row">
		<?php echo $form->labelEx($model,'total_tax_1'); ?>
		<?php echo $form->textField($model,'total_tax_1',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_tax_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_tax_2'); ?>
		<?php echo $form->textField($model,'total_tax_2',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_tax_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_amount'); ?>
		<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_amount'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'approved_by'); ?>
		<?php echo $form->textField($model,'approved_by'); ?>
		<?php echo $form->error($model,'approved_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approved_on'); ?>
		<?php echo $form->textField($model,'approved_on'); ?>
		<?php echo $form->error($model,'approved_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_comments'); ?>
		<?php echo $form->textField($model,'approval_comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'approval_comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'due_on'); ?>
		<?php echo $form->textField($model,'due_on'); ?>
		<?php echo $form->error($model,'due_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_date'); ?>
		<?php echo $form->textField($model,'status_date'); ?>
		<?php echo $form->error($model,'status_date'); ?>
	</div>

-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->