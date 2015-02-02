<?php
/* @var $this PartyController */
/* @var $model Party */

$this->breadcrumbs=array(
	'Parties'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'Customers', 'url'=>array('index','type'=>'Customer')),
//	array('label'=>'Vendors', 'url'=>array('index','type'=>'Vendor')),
//	array('label'=>'Agents', 'url'=>array('index','type'=>'Agent')),    
	array('label'=>'Create Party', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#party-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Parties</h1>

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
	'id'=>'party-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'short_code',
		'party_name',
                array(
                    'name'=>'party_type',
                    'filter'=>$model->getPartyTypes(),
                ),
                array(
                    'name'=>'is_blacklisted',
                    'filter'=>array('1'=>'Yes','0'=>'No'),
                    'value'=>'$data->is_blacklisted?"Yes":"No"',
                ),
		//'is_blacklisted',
		'pan_no',
		'service_tax_no',
		'credit_days',
		'debit_days',
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
