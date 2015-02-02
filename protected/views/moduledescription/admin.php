<?php
/* @var $this ModuledescriptionController */
/* @var $model Moduledescription */

$this->breadcrumbs=array(
	'Moduledescriptions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Moduledescription', 'url'=>array('index')),
	array('label'=>'Create Moduledescription', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#moduledescription-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Moduledescriptions</h1>

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
	'id'=>'moduledescription-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'invoice_id',
		'voucher_id',
		'description',
		'comments',
		'currency',
		/*
		'exchange_rate',
		'rate',
		'quantity',
		'amount',
		'tax_1',
		'tax_1_amount',
		'tax_2',
		'tax_2_amount',
		'isActive',
		'pass_id',
		'approve_id',
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
