<?php
/* @var $this WorkorderpackageController */
/* @var $model Workorderpackage */

$this->breadcrumbs=array(
	'Workorderpackages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Workorderpackage', 'url'=>array('index')),
	array('label'=>'Create Workorderpackage', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#workorderpackage-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Workorderpackages</h1>

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
	'id'=>'workorderpackage-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'workorder_id',
		'package_id',
		'trip_id',
		'transporter_id',
		'vehicle_type',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
