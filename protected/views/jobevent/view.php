<?php
/* @var $this JobeventController */
/* @var $model Jobevent */

$this->breadcrumbs=array(
	'Jobevents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Jobevent', 'url'=>array('index')),
	array('label'=>'Create Jobevent', 'url'=>array('create')),
	array('label'=>'Update Jobevent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Jobevent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jobevent', 'url'=>array('admin')),
);
?>

<h1>View Jobevent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'job_id',
		'event_id',
		'event_date',
		'document_ref',
		'comments',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
