<?php
/* @var $this ReceiptController */
/* @var $model Receipt */

$this->breadcrumbs=array(
	'Receipts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Unpaid Invoices', 'url'=>array('invoice/index')),
        array('label'=>'Paid Invoices', 'url'=>array('invoice/paidInvoices')),
        array('label'=>'Receipts', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#receipt-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Receipts</h1>

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
	'id'=>'receipt-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'receipt_date',
		//'branch_id',
                array(
                    'name'=>'party_id',
                    'filter'=>CHtml::listData(Party::model()->findAll(array('order'=>'party_name')),'id','party_name'),
                    'value'=>'isset($data->parties)?$data->parties->party_name:"  -  "',
                ),            
		'mode',
//		'instrument_no',
		
//		'instrument_date',
//		'instrument_bank',
		'currency',
		'exchange_rate',
		'TDS',
		'discount',
		'amount',
		'total_amount',
//		'created_by',
//		'created_on',
//		'updated_by',
//		'updated_on',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
