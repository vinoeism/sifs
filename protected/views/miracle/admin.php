<?php
/* @var $this MiracleController */
/* @var $model Miracle */

$this->breadcrumbs=array(
	'Miracles'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Miracle', 'url'=>array('index')),
	array('label'=>'Create Miracle', 'url'=>array('create')),
	array('label'=>'Add Prayer Request', 'url'=>array('createPrayerRequest')),
	array('label'=>'Add Testimony', 'url'=>array('createTestimony')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#miracle-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Miracles</h1>

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
	'id'=>'miracle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'miracle_date',
		'miracle_type',
		'recepient',
		'prayer_request',
		'start_date',
		/*
		'end_date',
		'warriors',
		'testimony',
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
