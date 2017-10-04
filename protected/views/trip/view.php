<?php
/* @var $this TripController */
/* @var $model Trip */

$this->breadcrumbs=array(
	'Trips'=>array('index'),
	$model->id,
);

$this->menu=array(
        array('label'=>'Add jobs', 'url'=>array('addjobs', 'id'=>$model->id)),
	array('label'=>'Update Trip', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Trip sheet', 'url'=>array('generateTripsheet','id'=>$model->id)),
	//array('label'=>'Delete Trip', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Trip', 'url'=>array('admin')),
);
?>

<h1>View Trip #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'vehicle_regn_no',
		'vehicle_type',
		'vehicle_id',
		'employee_id',
		'trip_type',
		'trip_date_start',
		'trip_date_end',
		'driver_name',
		'driver_phone',
		'in_time',
		'out_time',
		'start_odo',
		'end_odo',
		'from_location',
		'from_location_id',
		'to_location',
		'to_location_id',
		'job_id',
		'transporter_id',
		'package_id',
		'booked_by',
		'booked_on',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
