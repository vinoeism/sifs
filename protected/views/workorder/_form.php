<?php
/* @var $this WorkorderController */
/* @var $model Workorder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workorder-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'wo_date'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'wo_date',
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
		<?php echo $form->error($model,'wo_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transporter_id'); ?>
		<?php echo $form->dropDownList($model,'transporter_id', $model->getTransporterOptions(), array('prompt'=>'-- Select Transporter --',)); ?>
		<?php echo $form->error($model,'transporter_id'); ?>
	</div>
	
        <div class="row">
		<?php echo $form->labelEx($model,'vehicle_type'); ?>
		<?php echo $form->dropDownList($model,'vehicle_type', $model->getVehicleTypes(), array('prompt'=>'-- Select Vehicle Type --',)); ?>
		<?php echo $form->error($model,'vehicle_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vehicle_instructions'); ?>
		<?php echo $form->textArea($model,'vehicle_instructions',array('size'=>200,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'vehicle_instructions'); ?>
	</div>        
        
	<div class="row">
		<?php echo $form->labelEx($model,'trip_type'); ?>
		<?php echo $form->dropDownList($model,'trip_type', $model->getTripTypes(), array('prompt'=>'-- Select Trip Type --',)); ?>
		<?php echo $form->error($model,'trip_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_date_start'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'trip_date_start',
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
		<?php echo $form->error($model,'trip_date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trip_date_end'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'trip_date_end',
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
		<?php echo $form->error($model,'trip_date_end'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'in_time'); ?>
		<?php echo $form->textField($model,'in_time'); ?>
		<?php echo $form->error($model,'in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'out_time'); ?>
		<?php echo $form->textField($model,'out_time'); ?>
		<?php echo $form->error($model,'out_time'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'from_location'); ?>
		<?php echo $form->textArea($model,'from_location',array('size'=>300,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'from_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_location'); ?>
		<?php echo $form->textArea($model,'to_location',array('size'=>300,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'to_location'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->