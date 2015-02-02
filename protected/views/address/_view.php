<?php
/* @var $this AddressController */
/* @var $data Address */
?>

<div class="view">
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('party_id')); ?>:</b>
	<?php echo CHtml::encode($data->party_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_id')); ?>:</b>
	<?php echo CHtml::encode($data->bank_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />
        */ ?>
	<b><?php echo CHtml::encode($data->type).' Address'; ?> </b>
        <?php 
            if (!empty($data->branch_id) && !($data->branch_id==0))
                echo CHtml::link('edit',array('address/update','id'=>$data->id, 'modulename'=>'BRANCH', 'moduleid'=>$data->branch_id)); 
            if (!empty($data->party_id) && !($data->party_id==0))
                echo CHtml::link('edit',array('address/update','id'=>$data->id, 'modulename'=>'PARTY', 'moduleid'=>$data->party_id)); 
        ?>
	<br />

	<?php echo CHtml::encode($data->line_1); ?>
	<br />
        <?php if (empty($data->line_2)) { ?>
	<?php echo CHtml::encode($data->line_2); ?>
	<br />
        <?php } ?>
        
	<?php echo empty($data->district)?'':CHtml::encode($data->district).','; ?>
	<?php echo empty($data->state)?'':CHtml::encode($data->state).','; ?>
	<br />
	<?php echo CHtml::encode($data->country).' - '; ?>
	<?php echo CHtml::encode($data->pincode).'.'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landline_number')); ?>:</b>
	<?php echo CHtml::encode($data->landline_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax_number')); ?>:</b>
	<?php echo CHtml::encode($data->fax_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_1')); ?>:</b>
	<?php echo CHtml::encode($data->contact_1).'  '; ?>
	<b><?php echo CHtml::encode($data->contact_1_designation); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_1_phone')); ?>:</b>
	<?php echo CHtml::encode($data->contact_1_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_1_email')); ?>:</b>
	<?php echo CHtml::encode($data->contact_1_email); ?>
	<br />
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_2')); ?>:</b>
	<?php echo CHtml::encode($data->contact_2).'  '; ?>
	<b><?php echo CHtml::encode($data->contact_2_designation); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_2_phone')); ?>:</b>
	<?php echo CHtml::encode($data->contact_2_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_2_email')); ?>:</b>
	<?php echo CHtml::encode($data->contact_2_email); ?>
	<br />
	

</div>