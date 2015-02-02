<?php
/* @var $this ModuledescriptionController */
/* @var $model Moduledescription */

$this->breadcrumbs=array(
	'Moduledescriptions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Moduledescription', 'url'=>array('index')),
	array('label'=>'Create Moduledescription', 'url'=>array('create')),
	array('label'=>'Update Moduledescription', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Moduledescription', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Moduledescription', 'url'=>array('admin')),
);
?>

<h1>View item #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'voucher_id',
		'description',
		'comments',
		'currency',
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
	),
)); ?>
