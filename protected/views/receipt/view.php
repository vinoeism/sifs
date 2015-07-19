<?php
/* @var $this ReceiptController */
/* @var $model Receipt */

$this->breadcrumbs=array(
	'Receipts'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List Receipt', 'url'=>array('index')),
//	array('label'=>'Create Receipt', 'url'=>array('create')),
	array('label'=>'Update Receipt', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Receipt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Receipt', 'url'=>array('admin')),
);
?>

<h1>View Receipt #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'receipt_date',
		array(
                    'name'=>'branch_id',
                    'value'=>$model->branches->branch_name,
                ),
		array(
                    'name'=>'party_id',
                    'value'=>$model->parties->party_name,
                ),            
		'mode',
		'instrument_no',
		'instrument_date',
		'instrument_bank',
		'currency',
		'exchange_rate',
		'TDS',
		'discount',
		'amount',
		'total_amount',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>
