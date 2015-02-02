<?php
/* @var $this JobController */
/* @var $model Job */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'REFNO'); ?>
		<?php echo $form->textField($model,'REFNO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Client_REFNO'); ?>
		<?php echo $form->textField($model,'Client_REFNO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'init_date'); ?>
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
                        ),
                    ));
                ?>	
        </div>
    
	<div class="row">
		<?php echo $form->label($model,'branch_search'); ?>
		<?php echo $form->textField($model,'branch_search'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quote_id'); ?>
		<?php echo $form->textField($model,'quote_id'); ?>
	</div>
    	<div class="row">
		<?php echo $form->label($model,'shipp_search'); ?>
                <?php echo $form->textField($model,'shipp_search'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conee_search'); ?>
            	<?php echo $form->textField($model,'conee_search'); ?>
	</div> 
    
	<div class="row">
		<?php echo $form->label($model,'agnt_search'); ?>
		<?php echo $form->textField($model,'agnt_search'); ?>
	</div>
    
       	<div class="row">
		<?php echo $form->label($model,'cfs_search'); ?>
		<?php echo $form->textField($model,'cfs_search'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'transporter_search'); ?>
		<?php echo $form->textField($model,'transporter_search'); ?>
	</div>   
    
        <div class="row">
		<?php echo $form->labelEx($model,'isActive'); ?>
		<?php echo $form->checkBox($model,'isActive'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'packages'); ?>
		<?php echo $form->textField($model,'packages',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assessable_value'); ?>
		<?php echo $form->textField($model,'assessable_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duty_value'); ?>
		<?php echo $form->textField($model,'duty_value'); ?>
	</div>

    	<div class="row">
		<?php echo $form->label($model,'duty_date'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'duty_mode'); ?>
		<?php echo $form->textField($model,'duty_mode',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'type'); ?>
                <?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mode'); ?>
		<?php echo $form->textField($model,'mode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'terms'); ?>
                <?php echo $form->textField($model,'terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gross_weight'); ?>
		<?php echo $form->textField($model,'gross_weight'); ?>
		<?php echo $form->dropDownList($model,'gross_weight_unit',$model->getUnitsOptions()); ?>            
	</div>

	<div class="row">
		<?php echo $form->label($model,'nett_weight'); ?>
		<?php echo $form->textField($model,'nett_weight'); ?>
		<?php echo $form->dropDownList($model,'nett_weight_unit',$model->getUnitsOptions()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chargeable_weight'); ?>
		<?php echo $form->textField($model,'chargeable_weight'); ?>
                <?php echo $form->dropDownList($model,'chargeable_weight_unit',$model->getUnitsOptions()); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_references'); ?>
		<?php echo $form->textField($model,'document_references',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin'); ?>
		<?php echo $form->textField($model,'origin',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destination'); ?>
		<?php echo $form->textField($model,'destination',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transhipment'); ?>
		<?php echo $form->textField($model,'transhipment',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'carrier_name'); ?>
		<?php echo $form->textField($model,'carrier_name',array('size'=>60,'maxlength'=>100)); ?>
      		<?php echo $form->textField($model,'voyage_no',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pickup_date'); ?>
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
                        ),
                    ));
                ?>	</div>

	<div class="row">
		<?php echo $form->label($model,'stuffing_date'); ?>
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
                ?> 	</div>

	<div class="row">
		<?php echo $form->label($model,'BE_SB_no'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'bond_no'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'bond_comments'); ?>
		<?php echo $form->textField($model,'bond_comments',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'onboard_date'); ?>
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
                ?>	</div>

	<div class="row">
		<?php echo $form->label($model,'transhipment_arrival_date'); ?>
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
        </div>

	<div class="row">
		<?php echo $form->label($model,'transhipment_date'); ?>
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
        </div>

	<div class="row">
		<?php echo $form->label($model,'arrival_date'); ?>
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
        </div>

	<div class="row">
		<?php echo $form->label($model,'contr_nos'); ?>
		<?php echo $form->textArea($model,'contr_nos',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'truck_nos'); ?>
		<?php echo $form->textArea($model,'truck_nos',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enquiry_by'); ?>
		<?php echo $form->textField($model,'enquiry_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'handled_by'); ?>
		<?php echo $form->textField($model,'handled_by'); ?>
	</div>

    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->