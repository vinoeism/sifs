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
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->dropDownList($model,'branch_id',$branchesDataProvider); ?>
		<?php echo $form->dropDownList($model,'mode',$model->getModeOptions()); ?>
		<?php echo $form->textField($model,'REFNO',array('size'=>25,'maxlength'=>50)); ?>            
                <?php echo $form->error($model,'mode'); ?>
		<?php echo $form->error($model,'REFNO'); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'client_id | Client REF No(if any)'); ?>
		<?php echo $form->dropDownList($model,'client_id',$model->getPartyOptions(), array('prompt'=>'-- Select Client --',)); ?>
		<?php echo $form->textField($model,'Client_REFNO',array('size'=>20,'maxlength'=>50)); ?>            
                <?php echo $form->error($model,'client_id'); ?>
		<?php echo $form->error($model,'Client_REFNO'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'init_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'init_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'value'=>CTimestamp::formatDate('Y-m-d'),
                        ),
                    ));
                ?>
                <?php echo $form->error($model,'init_date'); ?>
	</div>

<!--
	<div class="row">
		<?php echo $form->labelEx($model,'quote_id'); ?>
		<?php echo $form->textField($model,'quote_id'); ?>
		<?php echo $form->error($model,'quote_id'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'Customer Name'); ?>
		<?php echo $form->dropDownList($model,'shipper',$model->getPartyOptions(), array('prompt'=>'-- Select Customer --',)); ?>
                <?php echo $form->error($model,'shipper'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'transporter'); ?>
		<?php echo $form->dropDownList($model,'shipper',$model->getTransporterOptions(), array('prompt'=>'-- Select Transporter --',)); ?>
                <?php echo $form->error($model,'transporter'); ?>
        </div>

        <div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textArea($model,'cargo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enquiry_by'); ?>
		<?php echo $form->dropDownList($model,'enquiry_by',$model->getUserOptions()); ?>
		<?php echo $form->error($model,'enquiry_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'handled_by'); ?>
		<?php echo $form->dropDownList($model,'handled_by',$model->getUserOptions()); ?>
		<?php echo $form->error($model,'handled_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->