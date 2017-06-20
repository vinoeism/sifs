<?php
/* @var $this WorkorderpackageController */
/* @var $model Workorderpackage */

$this->breadcrumbs=array(
	'Workorderpackages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Workorderpackage', 'url'=>array('index')),
	array('label'=>'Create Workorderpackage', 'url'=>array('create')),
	array('label'=>'Update Workorderpackage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Workorderpackage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Workorderpackage', 'url'=>array('admin')),
);
?>

<h1>View Workorderpackage #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'workorder_id',
		'package_id',
		'trip_id',
		'transporter_id',
		'vehicle_type',
		'vehicle_instructions',
		'trip_type',
		'trip_date_start',
		'trip_date_end',
		'in_time',
		'out_time',
		'from_location',
		'from_location_id',
		'to_location',
		'to_location_id',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
