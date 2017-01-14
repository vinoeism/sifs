<?php
/* @var $this WorkorderController */
/* @var $model Workorder */

$this->breadcrumbs=array(
	'Workorders'=>array('index'),
	$model->id,
);

$this->menu=array(
);
?>

<h1>View Workorder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'wo_date',
		'job_id',
		'trip_id',
		'transporter_id',
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
