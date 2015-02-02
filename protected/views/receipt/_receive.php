<?php
/* @var $this ReceiptController */
/* @var $model Receipt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'receipt-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'invoice-grid',
                'selectableRows' => '2',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'columns'=>array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'checked' => 'true',
                            'id' => 'ids',                  // ids represent what value inside???
                        ),
                        'id',
                        'REFNO',
                        'invoice_date',            
                        array(
                            'name'=>'job_id',
                            'filter'=>CHtml::listData(Job::model()->findAll(array('order'=>'REFNO')),'id','REFNO'),
                            'value'=>'isset($data->jobs)?$data->jobs->REFNO:"  -  "',
                        ),           
                        'total_tax_1',
                        'total_tax_2',
                        'total_amount',
                        'status', 
                        'due_on',
                        /*
                        'invoice_terms',
                        'created_by',
                        'created_on',
                        'updated_by',
                        'updated_on',
                        'approved_by',
                        'approved_on',
                        'approval_comments',
                        'status_date',
                        'is_active',
                        */

                ),
        )); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'receipt_date'); ?>
		<?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'receipt_date',
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
		<?php echo $form->error($model,'receipt_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mode'); ?>
		<?php echo $form->dropDownList($model,'mode',$model->getModeOptions()); ?>
		<?php echo $form->error($model,'mode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instrument_no'); ?>
		<?php echo $form->textField($model,'instrument_no',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->textField($model,'instrument_bank',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'instrument_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->dropDownList($model,'currency',  $model->getCurrencies()); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exchange_rate'); ?>
		<?php echo $form->textField($model,'exchange_rate',array('size'=>10,'maxlength'=>10,'value'=>'1')); ?>
		<?php echo $form->error($model,'exchange_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TDS'); ?>
		<?php echo $form->textField($model,'TDS',array('size'=>10,'maxlength'=>10,'value'=>'0.00')); ?>
		<?php echo $form->error($model,'TDS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model,'discount',array('size'=>10,'maxlength'=>10,'value'=>'0.00')); ?>
		<?php echo $form->error($model,'discount'); ?>
	</div>

	<div class="row">
		<br/><p class="note">Please enter the Amount without any TDS or Discount</p>
                <?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->