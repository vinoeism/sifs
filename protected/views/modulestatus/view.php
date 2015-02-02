<?php
/* @var $this ModulestatusController */
/* @var $model Modulestatus */

$this->breadcrumbs=array(
	'Modulestatuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Modulestatus', 'url'=>array('index')),
	array('label'=>'Create Modulestatus', 'url'=>array('create')),
	array('label'=>'Update Modulestatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Modulestatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Modulestatus', 'url'=>array('admin')),
);
?>

<h1>View Modulestatus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'job_id',
		'voucher_id',
		'bill_id',
		'payment_id',
		'receipt_id',
		'status',
		'comments',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
