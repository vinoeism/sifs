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
		<?php echo $form->labelEx($model,'voucher_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'voucher_date',
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
                <?php echo $form->error($model,'voucher_date'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->dropDownList($model,'branch_id',$branchesDataProvider); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'voucher_type'); ?>
		<?php echo $form->dropDownList($model,'voucher_type',$model->getTypeOptions()); ?>
		<?php echo $form->error($model,'voucher_type'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'towards'); ?>
		<?php echo $form->dropDownList($model,'towards',$expensesDataProvider); ?>
		<?php echo $form->error($model,'towards'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'pay_to'); ?>
		<?php echo $form->dropDownList($model,'pay_to',$model->getPayeeOptions()); ?>
		<?php echo $form->error($model,'pay_to'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'bill_no'); ?>
		<?php echo $form->textField($model,'bill_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'bill_no'); ?>
	</div>

 	<div class="row">
		<?php echo $form->labelEx($model,'bill_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'bill_date',
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
		<?php echo $form->error($model,'bill_date'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'bill_amount'); ?>
		<?php echo $form->textField($model,'bill_amount',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'bill_amount'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'due_on'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'due_on',
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
		<?php echo $form->error($model,'due_on'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'tds'); ?>
		<?php echo $form->textField($model,'tds',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'tds'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->dropDownList($model,'priority',$model->getPriorityOptions()); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->