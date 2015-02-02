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
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'voucher-grid',
                        'selectableRows' => '2',
                        'dataProvider'=>$voucherDataProvider,
                        //'filter'=>$model,
                        'columns'=>array(
                                array(
                                    'class' => 'CCheckBoxColumn',
                                    'checked' => 'true',
                                    'id' => 'ids',                  // ids represent what value inside???
                                ),
                                'id',
                                array(
                                    'name'=>'pay_to',
                                    //'filter'=>$model->getPayeeOptions(),
                                    'value'=>'isset($data->parties)?$data->parties->party_name:"  -  "',
                                ),                        
                                'voucher_date',
                                'voucher_type',
                                'towards',            
                                'total_amount',

                        ),
                )); ?>
        </div>
        
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
                            'value'=>CTimestamp::formatDate('Y/m/d')

                        ),
                    ));
                ?>
		<?php echo $form->error($model,'instrument_date'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'instrument_bank'); ?>
		<?php echo $form->dropdownList($model,'instrument_bank',$model->getBanks($model->branch_id)); ?>
		<?php echo $form->error($model,'instrument_bank'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->