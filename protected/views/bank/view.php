<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs=array(
	'Banks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bank', 'url'=>array('index')),
	array('label'=>'Create Bank', 'url'=>array('create')),
	array('label'=>'Update Bank', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bank', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bank', 'url'=>array('admin')),
);
?>

<h1>View Bank #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'party_id',
		'branch_id',
		'employee_id',
		'bank_name',
		'bank_address',
		'account_no',
		'ifsc_code',
		'swift_code',
		'comments',
		'status',
		'isActive',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
