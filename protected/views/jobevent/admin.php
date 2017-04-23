<?php
/* @var $this JobeventController */
/* @var $model Jobevent */

$this->breadcrumbs=array(
	'Jobevents'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Jobevent', 'url'=>array('index')),
	array('label'=>'Create Jobevent', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#jobevent-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jobevents</h1>

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
	'id'=>'jobevent-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'job_id',
		'event_id',
		'event_date',
		'document_ref',
		'comments',
		/*
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
