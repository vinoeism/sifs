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
        <h1>Add/Edit a Package</h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
                <?php echo $form->dropDownList($model,'type',$model->getTypesOptions()); ?> 
                <?php echo $form->dropDownList($model,'subtype',$model->getPkgOptions()); ?>                                                            
		<?php echo $form->error($model,'type'); ?>
		<?php echo $form->error($model,'subtype'); ?>            
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'length    |    breadth    |    height'); ?>
		<?php echo $form->textField($model,'length'); ?>
		<?php echo $form->textField($model,'breadth'); ?>
		<?php echo $form->textField($model,'height'); ?>            
                <?php echo $form->dropDownList($model,'dimension_unit',$model->getDimensionUnitsOptions()); ?>                                    
            
		<?php echo $form->error($model,'length'); ?>
		<?php echo $form->error($model,'breadth'); ?>            
		<?php echo $form->error($model,'height'); ?>
		<?php echo $form->error($model,'dimension_unit'); ?>            
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Gross weight | Nett Weight | Chargeable Weight'); ?>
		<?php echo $form->textField($model,'gross_weight'); ?>
		<?php echo $form->textField($model,'net_weight'); ?>
		<?php echo $form->textField($model,'chargeable_weight'); ?>
                <?php echo $form->dropDownList($model,'weight_unit',$model->getWeightUnitsOptions()); ?>                        
		<?php echo $form->error($model,'gross_weight'); ?>
		<?php echo $form->error($model,'net_weight'); ?>
		<?php echo $form->error($model,'chargeable_weight'); ?>
		<?php echo $form->error($model,'weight_unit'); ?>     
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
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