<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Payment', 'url'=>array('index')),
	//array('label'=>'Create Payment', 'url'=>array('create')),
	array('label'=>'Unpaid Vouchers', 'url'=>array('voucher/index')),
        array('label'=>'Paid Vouchers', 'url'=>array('voucher/paidVouchers')),
        array('label'=>'Payments', 'url'=>array('payment/index')),
        
);
$this->sidemenu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('voucher/create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#payment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Payments</h1>

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
	'id'=>'payment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'id',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),		'payment_date',
                array(
                    'name'=>'party_id',
                    'value' => 'isset($data->party_id)?$data->parties->party_name:"  -  "',
                ),
//		'employee_id',
		//'payment_type',
                array(
                    'name'=>'mode',
                    'filter'=>array('CASH'=>'Cash','CHEQUE'=>'Cheque', 'TRANSFER'=>'Bank Transfer'),
                    'value' => '$data->mode',
                    
                ),
		'currency',
		'exchange_rate',
		'amount',            
		'total_amount',
		/*
		'instrument_no',
		'instrument_date',
		'instrument_bank',
		'transaction_no',
		'currency',
		'exchange_rate',
		'tds',
		'amount',
		'total_amount',
		'status',
		'remaining_amount',
		'is_adhoc',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
		*/
	),
)); ?>
