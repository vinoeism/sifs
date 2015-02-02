<?php
/* @var $this TaskController */
/* @var $data Task */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('task/view', 'id'=>$data->id)); ?>
        <?php if ($data->status == Task::STATUS_CLOSED) { 
            echo '[ '.CHtml::link('re-open', array('task/reopen', 'id'=>$data->id)).' ]'; 
        } elseif ($data->status == Task::STATUS_COMPLETED) {   
            echo '[ '.CHtml::link('close', array('task/close', 'id'=>$data->id)).' ]'; 
        } else {
            echo '[ '.CHtml::link('transfer', array('task/transfer', 'id'=>$data->id)).' ]'; 
            echo '[ '.CHtml::link('complete', array('task/complete', 'id'=>$data->id)).' ]'; 
        }
        ?>
	<br />

        <b><?php echo CHtml::encode($data->status).' / '.CHtml::encode($data->priority); ?></b>
        <?php echo empty($data->due_date)?'':'due on '.CHtml::encode($data->due_date); ?>
        <br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
	<?php echo CHtml::encode(isset($data->owners)?$data->owners->username:"Not set"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allotted_by')); ?>:</b>
	<?php echo CHtml::encode(isset($data->allotters)?$data->allotters->username:"Not set"); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('allotted_to')); ?>:</b>
	<?php echo CHtml::encode($data->allotted_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('due_date')); ?>:</b>
	<?php echo CHtml::encode($data->due_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transferred_to')); ?>:</b>
	<?php echo CHtml::encode($data->transferred_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transfer_reason')); ?>:</b>
	<?php echo CHtml::encode($data->transfer_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('completed_on')); ?>:</b>
	<?php echo CHtml::encode($data->completed_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complete_comments')); ?>:</b>
	<?php echo CHtml::encode($data->complete_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('closed_on')); ?>:</b>
	<?php echo CHtml::encode($data->closed_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('closure_comments')); ?>:</b>
	<?php echo CHtml::encode($data->closure_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on); ?>
	<br />

	*/ ?>

</div>