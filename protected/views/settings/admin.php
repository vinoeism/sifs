<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Settings', 'url'=>array('create')),
    	//array('label'=>'Manage Currencies', 'url'=>array('index')),
        array('label'=>'Manage Branches', 'url'=>array('branch/admin')),
        array('label'=>'Manage Job Events', 'url'=>array('event/admin')),
        array('label'=>'Manage rights', 'url'=>array('/rights/authitem/permissions'))
);
$this->sidemenu = array(
//            array('label'=>'Update Cargo details', 'url'=>array('update', 'id'=>$model->id, 'formName'=>'CARGO')),    
            array('label'=>'Add Job Expense', 'url'=>array('create', 'type'=>'jobexpense')),            
            array('label'=>'Add Branch Expense', 'url'=>array('create', 'type'=>'branchexpense')),            
            array('label'=>'Add Trip type', 'url'=>array('create', 'type'=>'triptype', 'subtype'=>'vehicle')),            
            array('label'=>'Add Vehicle type', 'url'=>array('create', 'type'=>'vehicle', 'subtype'=>'type')),            

            //array('label'=>'Add Branch Expense', 'url'=>array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
            //array('label'=>'Add Job Item', 'url'=>array('invoice/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
    );
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Settings</h1>

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
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name' => 'setting_key',
                    'filter'=>CHtml::listData(Settings::model()->findAll(array('order'=>'setting_key')),'setting_key','setting_key'),                    
                    'value' => 'isset($data->setting_key)?$data->setting_key:"  -  "',
                ),            
//		'setting_key',
		'setting_subkey',
		'setting_value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
