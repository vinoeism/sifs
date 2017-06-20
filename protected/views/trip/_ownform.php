<?php
/* @var $this TripController */
/* @var $model Trip */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trip-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'vehicle_id'); ?>
		<?php echo $form->dropDownList($model,'vehicle_id', $model->getVehicles(), array('prompt'=>'-- Select Vehicle --',)); ?>
		<?php echo $form->error($model,'vehicle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Driver '); ?>
		<?php echo $form->dropDownList($model,'employee_id', $model->getDrivers(), array('prompt'=>'-- Select Driver --',)); ?>
		<?php echo $form->error($model,'employee_id'); ?>
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
		<?php echo $form->labelEx($model,'driver_name'); ?>
		<?php echo $form->dropDownList($model,'driver_name', $model->getTripTypes(), array('prompt'=>'-- Select Driver --',)); ?>
		<?php echo $form->error($model,'driver_name'); ?>
	</div>-->
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'driver_phone'); ?>
		<?php echo $form->textField($model,'driver_phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'driver_phone'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'in_time'); ?>
		<?php echo $form->textField($model,'in_time'); ?>
		<?php echo $form->error($model,'in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'out_time'); ?>
		<?php echo $form->textField($model,'out_time'); ?>
		<?php echo $form->error($model,'out_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_odo'); ?>
		<?php echo $form->textField($model,'start_odo'); ?>
		<?php echo $form->error($model,'start_odo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_odo'); ?>
		<?php echo $form->textField($model,'end_odo'); ?>
		<?php echo $form->error($model,'end_odo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_location'); ?>
		<?php echo $form->textField($model,'from_location',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'from_location'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'to_location'); ?>
		<?php echo $form->textField($model,'to_location',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'to_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'booked_by'); ?>
		<?php echo $form->dropDownList($model,'booked_by',$model->getUserOptions()); ?>
		<?php echo $form->error($model,'booked_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'booked_on'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'booked_on',
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
		<?php echo $form->error($model,'booked_on'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->