<?php
/* @var $this AddressController */
/* @var $model Address */

$this->breadcrumbs=array(
	'Addresses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Address', 'url'=>array('index')),
	array('label'=>'Create Address', 'url'=>array('create')),
	array('label'=>'Update Address', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Address', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Address', 'url'=>array('admin')),
);
?>

<h1>View Address #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'party_id',
		'bank_id',
		'employee_id',
		'branch_id',
		'type',
		'line_1',
		'line_2',
		'district',
		'state',
		'country',
		'pincode',
		'landline_number',
		'fax_number',
		'website',
		'contact_1',
		'contact_1_designation',
		'contact_1_phone',
		'contact_1_email',
		'contact_2',
		'contact_2_designation',
		'contact_2_phone',
		'contact_2_email',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
