<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Payment', 'url'=>array('index')),
	//array('label'=>'Update Payment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Unpaid Vouchers', 'url'=>array('voucher/index')),
        array('label'=>'Paid Vouchers', 'url'=>array('voucher/paidVouchers')),
        array('label'=>'Payments', 'url'=>array('payment/index')),
        
);
$this->sidemenu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('voucher/create')),
        array('label'=>'Generate Payment receipt', 'url'=>array('payment/generatePaymentReceipt','id'=>$model->id)),
);
?>

<h1>View <?php echo $model->mode; ?> Payment #<?php echo $model->id; ?> dtd. <?php echo $model->payment_date; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                array(
                    'name'=>'party_id',
                    'value'=>CHtml::encode(isset($model->parties)?$model->parties->party_name:"Not set"),
                ),
                'currency',
		'exchange_rate',
		'amount',
		'total_amount',

	),
)); ?>

<br/>

<?php if ($model->mode == 'CHEQUE') { ?>
<h3>Bank details </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'instrument_no',
		'instrument_date',
		'instrument_bank',
	),
)); ?>

<?php } ?>

<?php if ($model->mode == 'TRANSFER') { ?>
<h3>Bank details </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'instrument_bank',
		'transaction_no',
	),
)); ?>

<?php } ?>