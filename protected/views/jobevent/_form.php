<?php
/* @var $this JobeventController */
/* @var $model Jobevent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jobevent-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'event_date'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'event_date',
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
		<?php echo $form->error($model,'event_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_ref'); ?>
		<?php echo $form->textField($model,'document_ref',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'document_ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>100,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->