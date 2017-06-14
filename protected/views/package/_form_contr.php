<?php
/* @var $this PackageController */
/* @var $model Package */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'package-form',
	'enableAjaxValidation'=>false,
)); ?>
        <h1>Add/Edit a Container</h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'contr_no'); ?>
                <?php
                $options = array(
                    'model'       => $model,
                    'attribute'   => 'name',
                    'mask'        => 'AAAAnnnnnnn',
                    'charMap'     => array( 'A' => '[A-Z, a-z]', 'n' => '[0-9]', ),
                    'htmlOptions' => array( 'class' => 'form-control' )
                );
                $this->widget( 'CMaskedTextField', $options ); ?>
                <?php echo $form->dropDownList($model,'subtype',$model->getContrOptions()); ?>                                                                        
		<?php echo $form->error($model,'name'); ?>
		<?php echo $form->error($model,'subtype'); ?>                        
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Gross weight | Nett Weight'); ?>
		<?php echo $form->textField($model,'gross_weight'); ?>
		<?php echo $form->textField($model,'net_weight'); ?>
                <?php echo $form->dropDownList($model,'weight_unit',$model->getWeightUnitsOptions()); ?>                        
		<?php echo $form->error($model,'gross_weight'); ?>
		<?php echo $form->error($model,'net_weight'); ?>
		<?php echo $form->error($model,'weight_unit'); ?>     
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabel($model,'Cargo Description', array('required' => true)); ?>
		<?php echo $form->textarea($model,'cargo',array('size'=>100,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->