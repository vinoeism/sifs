<?php
/* @var $this VoucherController */
/* @var $model Voucher */

$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Voucher', 'url'=>array('create','branchID'=>$model->branch_id)),
        //array('label'=>'Update Voucher', 'url'=>array('update', 'id'=>$model->id)),

);
if (!isset($model->passed_by) || (isset($model->rejected_by))){
    $this->menu[] = array('label'=>'Update Voucher', 'url'=>array('update', 'id'=>$model->id));
}

//further menu manipulation at the bottom, during discount calculation
?>

<h1><?php echo $model->voucher_type; ?> Voucher #<?php echo $model->id; ?> dtd. <?php echo $model->voucher_date; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'towards',            
		'total_tax_1',
		'total_tax_2',
		'total_amount',
		'comments',
		'priority',
                'tds',
                'discount',

	),
)); ?>
<br/>
<h2><?php echo $model->parties->party_name; ?> -- Bill details </h2>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bill_no',            
		'bill_date',
		'bill_amount',
	),
)); ?>
<br/> <br/>

<?php if (isset($model->passed_by)) { ?>
    <i>Passed by</i><b><i> <?php echo $model->passers->username; ?></i></b> <i> on </i><b><i><?php echo $model->passed_on; ?> </i></b> <br/>
    <b> <?php echo $model->passed_comments; ?></b>
    <br/> <br/>
<?php } ?>
<?php if (isset($model->approved_by)) { ?>
    <i>Approved by</i><b><i> <?php echo $model->approvers->username; ?></i></b> <i> on </i><b><i><?php echo $model->approved_on; ?> </i></b> <br/>
    <b> <?php echo $model->approval_comments; ?></b>
<?php }?>
<?php if (isset($model->rejected_by)) { ?>
    <i>Rejected by</i><b><i> <?php echo $model->rejecters->username; ?></i></b> <i> on </i><b><i><?php echo $model->rejected_on; ?> </i></b> <br/>
    <b> <?php echo $model->rejection_comments; ?></b>
<?php }?>
<?php if (isset($model->approved_by)) { ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'moduledescription-grid',
            'dataProvider'=>$itemsDataProvider,
            'columns'=>array(
    //		'id',
    //		'invoice_id',
    //		'voucher_id',
                    'description',
    //		'comments',
                    'currency',	
                    'exchange_rate',
                    'rate',
                    'quantity',
                    'amount',
                    //'tax_1',
                    'tax_1_amount',
                    //'tax_2',
                    'tax_2_amount',
    //		'isActive',
    //		'pass_id',
    //		'approve_id',

            ),
    )); ?>
<?php } else { ?>   
    <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'moduledescription-grid',
            'dataProvider'=>$itemsDataProvider,
            'columns'=>array(
    //		'id',
    //		'invoice_id',
    //		'voucher_id',
                    'description',
    //		'comments',
                    'currency',	
                    'exchange_rate',
                    'rate',
                    'quantity',
                    'amount',
                    //'tax_1',
                    'tax_1_amount',
                    //'tax_2',
                    'tax_2_amount',
    //		'isActive',
    //		'pass_id',
    //		'approve_id',
    //		'created_by',
    //		'created_on',
    //		'updated_by',
    //		'updated_on',
                    array(
                            'class'=>'CLinkColumn',
                            'label'=>'edit',
                            'urlExpression'=>'Yii::app()->createUrl("moduledescription/update",array("id"=>$data->id))',
                            //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                    ),
                    array(
                            'class'=>'CLinkColumn',
                            'label'=>'delete',
                            'urlExpression'=>'Yii::app()->createUrl("moduledescription/delete",array("id"=>$data->id))',
                    ),
            ),
    )); ?>
<?php }?>

    
<?php
    $netamount = isset($model->total_amount) && $model->total_amount!=0?$model->total_amount:0;
    if (isset($model->total_tax_1) && ($model->total_tax_1!=0))
        $netamount = $netamount + $model->total_tax_1;
    if (isset($model->total_tax_2) && ($model->total_tax_2!=0))
        $netamount = $netamount + $model->total_tax_2;
    if (isset($model->tds) && ($model->tds!=0))
        $netamount = $netamount + $model->tds;
    if (isset($model->discount) && ($model->discount!=0))
        $netamount = $netamount + $model->discount;
    if ($model->bill_amount > $netamount && $netamount !=0)
    {
?>

    <img src="images/alert_icon.gif" alt="Warning!">  Bill amount doesn't match with voucher amount. Click <?php echo CHtml::link('here',array('discount', 'id'=>$model->id)); ?> to treat the difference as discount.
    
<?php } elseif ($model->bill_amount < $netamount && $netamount !=0) { ?>

    <img src="images/alert_icon.gif" alt="Warning!">  Bill amount doesn't match with voucher amount. Edit voucher items (or) correct the bill amount.


<?php }  
    
    if ($itemsDataProvider->itemCount == 0 && !isset($model->passed_by) && !isset($model->approved_by)){
        $this->sidemenu=array(
            array('label'=>'Add item', 'url'=>array('moduledescription/create','moduleid'=>$model->id,'modulename'=>'VOUCHER')),
        );
    } else if (!isset($model->passed_by)){
        $this->sidemenu=array(
            array('label'=>'Add item', 'url'=>array('moduledescription/create','moduleid'=>$model->id,'modulename'=>'VOUCHER')),
            array('label'=>'Pass Voucher', 'url'=>array('pass', 'id'=>$model->id)),
            array('label'=>'Approve Voucher', 'url'=>array('approve', 'id'=>$model->id)),
            array('label'=>'Reject Voucher', 'url'=>array('reject', 'id'=>$model->id)),
        );

    } else if (!isset($model->approved_by)) {
        $this->sidemenu=array(
            array('label'=>'Approve Voucher', 'url'=>array('approve', 'id'=>$model->id)),
            array('label'=>'Reject Voucher', 'url'=>array('reject', 'id'=>$model->id)),
        );    
    } else if (isset($model->rejected_by)) {
        $this->sidemenu=array(
            array('label'=>'Approve Voucher', 'url'=>array('approve', 'id'=>$model->id)),
        );    
    }

?>

    
<?php

if (isset($model->payments)) {
    $payments = $model->payments;
    foreach($payments as $payment)
    {
        
?>    
            <h1>Payment #<?php echo $payment->id; ?> dtd. <?php echo $payment->payment_date; ?></h1>
            <i>Created by</i><b><i> <?php echo $payment->created_by; ?></i></b> <i>on</i><b><i> <?php echo $payment->created_on; ?></i></b> <br/>
            <i>Last updated by</i><b><i> <?php echo $payment->updated_by; ?></i></b> <i> on </i><b><i><?php echo $payment->updated_on; ?> </i></b> <br/><br/>

            <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$payment,
                    'attributes'=>array(
                            array(
                                'name'=>'party_id',
                                'value'=>CHtml::encode(isset($payment->parties)?$payment->parties->party_name:"Not set"),
                            ),
                            'currency',
                            'exchange_rate',
                            'amount',
                            'total_amount',

                    ),
            )); ?>

            <br/>

            <?php if ($payment->mode == 'CHEQUE') { ?>
            <h3>Bank details </h3>
            <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$payment,
                    'attributes'=>array(
                            'instrument_no',
                            'instrument_date',
                            array(
                                'name'=>'instrument_bank',
                                'value'=>CHtml::encode(isset($payment->banks)?$payment->banks->bank_name:"Not set"),
                            ),
                        ),
            )); ?>

            <?php } ?>

            <?php if ($payment->mode == 'TRANSFER') { ?>
            <h3>Bank details </h3>
            <?php $this->widget('zii.widgets.CDetailView', array(
                    'data'=>$payment,
                    'attributes'=>array(
                            array(
                                'name'=>'instrument_bank',
                                'value'=>CHtml::encode(isset($payment->banks)?$payment->banks->bank_name:"Not set"),
                            ),
                            'transaction_no',
                    ),
                )); 
            }
            ?>
<?php
        
      }
        
}


?>


