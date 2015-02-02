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
		<?php echo $form->labelEx($model,'REFNO'); ?>
		<?php echo $form->textField($model,'REFNO',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'REFNO'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'client_id'); ?>
		<?php echo $form->dropDownList($model,'client_id',$model->getPartyOptions(), array('prompt'=>'-- Select Client --',)); ?>
                <?php echo $form->error($model,'client_id'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'Client_REFNO'); ?>
		<?php echo $form->textField($model,'Client_REFNO',array('size'=>50,'maxlength'=>50)); ?>
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
                            'value'=>CTimestamp::formatDate('Y/m/d')
                        ),
                    ));
                ?>
                <?php echo $form->error($model,'init_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->dropDownList($model,'branch_id',$branchesDataProvider); ?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'quote_id'); ?>
		<?php echo $form->textField($model,'quote_id'); ?>
		<?php echo $form->error($model,'quote_id'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'shipper | consignee | agent | CFS | Transporter'); ?>
		<?php echo $form->dropDownList($model,'shipper',$model->getPartyOptions(), array('prompt'=>'-- Select Shipper --',)); ?>
            	<?php echo $form->dropDownList($model,'consignee',$model->getPartyOptions(), array('prompt'=>'-- Select Consignee --',)); ?>
		<?php echo $form->dropDownList($model,'agent',$model->getPartyOptions(), array('prompt'=>'-- Select Agent --',)); ?>
		<?php echo $form->dropDownList($model,'cfs_id',$model->getPartyOptions(), array('prompt'=>'-- Select CFS --',)); ?>
		<?php echo $form->dropDownList($model,'transporter',$model->getPartyOptions(), array('prompt'=>'-- Select Transporter --',)); ?>
                <?php echo $form->error($model,'shipper'); ?>
                <?php echo $form->error($model,'consignee'); ?>
		<?php echo $form->error($model,'agent'); ?>
		<?php echo $form->error($model,'cfs_id'); ?>
            	<?php echo $form->error($model,'transporter'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'isActive'); ?>
		<?php echo $form->checkBox($model,'isActive',array('checked'=>'checked')); ?>
		<?php echo $form->error($model,'isActive'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'type / mode / terms'); ?>
		<?php echo $form->dropDownList($model,'type',$model->getTypeOptions()); ?>
		<?php echo $form->dropDownList($model,'mode',$model->getModeOptions()); ?>
                <?php echo $form->dropDownList($model,'terms',$model->getTermsOptions()); ?>
                <?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'packages'); ?>
		<?php echo $form->textField($model,'packages',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'packages'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'gross_weight'); ?>
		<?php echo $form->textField($model,'gross_weight'); ?>
		<?php echo $form->dropDownList($model,'gross_weight_unit',$model->getUnitsOptions()); ?>            
		<?php echo $form->error($model,'gross_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nett_weight'); ?>
		<?php echo $form->textField($model,'nett_weight'); ?>
		<?php echo $form->dropDownList($model,'nett_weight_unit',$model->getUnitsOptions()); ?>
		<?php echo $form->error($model,'nett_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chargeable_weight'); ?>
		<?php echo $form->textField($model,'chargeable_weight'); ?>
                <?php echo $form->dropDownList($model,'chargeable_weight_unit',$model->getUnitsOptions()); ?>
                <?php echo $form->error($model,'chargeable_weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_references'); ?>
		<?php echo $form->textField($model,'document_references',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'document_references'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origin >> transhipment >> destination'); ?>
		<?php echo $form->textField($model,'origin',array('size'=>40,'maxlength'=>50)).'  to '; ?>
		<?php echo $form->textField($model,'transhipment',array('size'=>40,'maxlength'=>50)).'  to '; ?>            
		<?php echo $form->textField($model,'destination',array('size'=>40,'maxlength'=>50)); ?>
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
		<?php echo $form->labelEx($model,'carrier_name / voyage_no'); ?>
		<?php echo $form->textField($model,'carrier_name',array('size'=>60,'maxlength'=>100)); ?>
            	<?php echo $form->textField($model,'voyage_no',array('size'=>10,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'carrier_name'); ?>
            	<?php echo $form->error($model,'voyage_no'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'BE_SB_no / Date'); ?>
		<?php echo $form->textField($model,'BE_SB_no',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->textField($model,'bond_no',array('size'=>20,'maxlength'=>20)); ?>
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
		<?php echo $form->textField($model,'bond_comments',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'bond_comments'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contr_nos'); ?>
		<?php echo $form->textArea($model,'contr_nos',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'contr_nos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'truck_nos'); ?>
		<?php echo $form->textArea($model,'truck_nos',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'truck_nos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enquiry_by'); ?>
		<?php echo $form->textField($model,'enquiry_by'); ?>
		<?php echo $form->error($model,'enquiry_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'handled_by'); ?>
		<?php echo $form->textField($model,'handled_by'); ?>
		<?php echo $form->error($model,'handled_by'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
		<?php echo $form->error($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_on'); ?>
		<?php echo $form->textField($model,'updated_on'); ?>
		<?php echo $form->error($model,'updated_on'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->