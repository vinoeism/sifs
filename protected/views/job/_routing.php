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
		<?php echo $form->labelEx($model,'CFS | Transporter'); ?>
		<?php echo $form->dropDownList($model,'cfs_id',$model->getCFSOptions(), array('prompt'=>'-- Select CFS --',)); ?>
		<?php echo $form->dropDownList($model,'transporter',$model->getTransporterOptions(), array('prompt'=>'-- Select Transporter --',)); ?>
		<?php echo $form->error($model,'cfs_id'); ?>
            	<?php echo $form->error($model,'transporter'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'origin >> transhipment >> destination'); ?>
		<?php echo $form->textField($model,'origin',array('size'=>40,'maxlength'=>30, 'placeholder'=>'Origin port')).'  to '; ?>
		<?php echo $form->textField($model,'transhipment',array('size'=>40,'maxlength'=>30, 'placeholder'=>'Transhipment port')).'  to '; ?>            
		<?php echo $form->textField($model,'destination',array('size'=>40,'maxlength'=>30, 'placeholder'=>'Destination port')); ?>
		<?php echo $form->error($model,'origin'); ?>
		<?php echo $form->error($model,'transhipment'); ?>            
		<?php echo $form->error($model,'destination'); ?>            
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pickup_date >> stuffing_date >> onboard_date >> transhipment_arrival_date >> transhipment_date >> arrival_date'); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'pickup_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Pickup',
                        ),

                    ));
                ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'stuffing_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Stuffing',

                        ),
                    ));
                ?>   
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'onboard_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Onboard',
                        ),
                    ));
                ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'transhipment_arrival_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Trans Arrival',
                        ),
                    ));
                ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'transhipment_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Trans Departure',
                        ),
                    ));
                ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'arrival_date',
                        'options' => array(
                            'showOn' => 'both', // also opens with a button
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'size' => '12', // textField size
                            'maxlength' => '12', // textField maxlength
                            'placeholder' => 'Final Arrival',
                        ),
                    ));
                ?>            
		<?php echo $form->error($model,'onboard_date'); ?>
            	<?php echo $form->error($model,'transhipment_arrival_date'); ?>
                <?php echo $form->error($model,'transhipment_date'); ?>
            	<?php echo $form->error($model,'arrival_date'); ?>
 		<?php echo $form->error($model,'pickup_date'); ?>
            	<?php echo $form->error($model,'stuffing_date'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'liner_carrier_name / voyage_no'); ?>
		<?php echo $form->textField($model,'liner_carrier_name',array('size'=>60,'maxlength'=>100)); ?>
            	<?php echo $form->textField($model,'voyage_no',array('size'=>10,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'liner_carrier_name'); ?>
            	<?php echo $form->error($model,'voyage_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'truck_nos'); ?>
		<?php echo $form->textArea($model,'truck_nos',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'truck_nos'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->