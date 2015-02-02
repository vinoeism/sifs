<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'payment_date',
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
		<?php echo $form->error($model,'payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'party_id'); ?>
		<?php echo $form->textField($model,'party_id'); ?>
		<?php echo $form->error($model,'party_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employee_id'); ?>
		<?php echo $form->textField($model,'employee_id'); ?>
		<?php echo $form->error($model,'employee_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_type'); ?>
		<?php echo $form->textField($model,'payment_type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'payment_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mode'); ?>
		<?php echo $form->textField($model,'mode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'mode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instrument_no'); ?>
		<?php echo $form->textField($model,'instrument_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'instrument_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instrument_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'instrument_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                        ),
                    ));
                ?>
		<?php echo $form->error($model,'instrument_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instrument_bank'); ?>
		<?php echo $form->textField($model,'instrument_bank',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'instrument_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_no'); ?>
		<?php echo $form->textField($model,'transaction_no',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'transaction_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->dropDownList($model,'currency',$model->getCurrencies()); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exchange_rate'); ?>
		<?php echo $form->textField($model,'exchange_rate',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'exchange_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tds'); ?>
		<?php echo $form->textField($model,'tds',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tds'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_amount'); ?>
		<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remaining_amount'); ?>
		<?php echo $form->textField($model,'remaining_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'remaining_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_adhoc'); ?>
		<?php echo $form->textField($model,'is_adhoc'); ?>
		<?php echo $form->error($model,'is_adhoc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->