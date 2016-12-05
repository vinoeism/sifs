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
        <?php if ($model->type == 'IMPORT') { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'assessable_value'); ?>
		<?php echo $form->textField($model,'assessable_value'); ?>
		<?php echo $form->error($model,'assessable_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duty_value'); ?>
		<?php echo $form->textField($model,'duty_value'); ?>
		<?php echo $form->error($model,'duty_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duty_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'duty_date',
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
		<?php echo $form->error($model,'duty_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duty_mode'); ?>
		<?php echo $form->textField($model,'duty_mode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'duty_mode'); ?>
	</div>
        <?php } ?>
	<div class="row">
		<?php echo $form->labelEx($model,'document_references'); ?>
		<?php echo $form->textField($model,'document_references',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'document_references'); ?>
	</div>
        
	<div class="row">
		<?php if ($model->type == 'IMPORT') {
                    echo $form->labelEx($model,'Bill of Entry / Date'); 
                } else {
                    echo $form->labelEx($model,'Shipping Bill No / Date'); 

                }
                    ?>
		<?php echo $form->textField($model,'BE_SB_no',array('size'=>30,'maxlength'=>50)); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'BE_SB_date',
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
		<?php echo $form->error($model,'BE_SB_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bond_no / Date'); ?>
		<?php echo $form->textField($model,'bond_no',array('size'=>30,'maxlength'=>20)); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'bond_date',
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
		<?php echo $form->error($model,'bond_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bond_comments'); ?>
		<?php echo $form->textArea($model,'bond_comments',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'bond_comments'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'mbl_mawb_no / Date'); ?>
		<?php echo $form->textField($model,'mbl_mawb_no',array('size'=>20,'maxlength'=>50)); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'mbl_mawb_date',
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
		<?php echo $form->error($model,'bond_no'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'hbl_hawb_no / Date'); ?>
		<?php echo $form->textField($model,'hbl_hawb_no',array('size'=>30,'maxlength'=>20)); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'hbl_hawb_no',
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
		<?php echo $form->error($model,'bond_no'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->