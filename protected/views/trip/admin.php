<?php
/* @var $this TripController */
/* @var $model Trip */

$this->breadcrumbs=array(
	'Trips'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Trip', 'url'=>array('index')),
	array('label'=>'Create Trip', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#trip-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Trips</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trip-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'vehicle_regn_no',
		'vehicle_type',
		'vehicle_id',
		'employee_id',
		'trip_type',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
