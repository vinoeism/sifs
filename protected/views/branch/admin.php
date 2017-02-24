<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Create Branch', 'url'=>array('create')),
        array('label'=>'Manage Tasks', 'url'=>array('task/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#branch-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Branches</h1>

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
	'id'=>'branch-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		//'id',
		'branch_name',
                'branch_code',
		'branch_location',
        	array(
                    'name'=>'is_registered_office',
                    'type'=>'raw',
                    'filter'=>'',
                    'htmlOptions'=>array('style' => 'text-align: center;'),
                    'value'=>'($data->is_registered_office==1)?CHtml::image(\'images/active.png\',\'Yes\', array(\'height\'=>\'14px\')):CHtml::image(\'images/inactive.png\',\'Yes\', array(\'height\'=>\'14px\'))',   
                ),            
		'PAN_no',
		'ST_registration_no',
		/*
		'comments',
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
