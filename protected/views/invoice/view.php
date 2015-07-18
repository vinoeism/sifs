<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update Invoice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invoice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Invoice', 'url'=>array('index')),
        array('label'=>'Print PDF', 'url'=>array('printPDF', 'id'=>$model->id),'linkOptions'=> array('target'=>'_blank')),
);
$this->sidemenu=array(
    array('label'=>'Add item', 'url'=>array('moduledescription/create','moduleid'=>$model->id,'modulename'=>'INVOICE')),
);
?>

<h1>View Invoice #<?php echo $model->id.' - '.$model->REFNO; ?> dtd. <?php echo $model->invoice_date; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
                    'name'=>'branch_id',
                    'value'=>$model->branches->branch_name,
                ),
		array(
                    'name'=>'job_id',
                    'value'=>$model->jobs->REFNO,
                ),		
		array(
                    'name'=>'party_id',
                    'value'=>$model->parties->party_name,
                ),		
		'invoice_terms',
		'total_tax_1',
		'total_tax_2',
		'total_amount',
		'due_on',
		'status',
		'status_date',
		'is_active',
	),
)); ?>
<br/><br/>
<?php if (isset($model->approved_by)) { ?>
    <i>Approved by</i><b><i> <?php echo $model->approvers->username; ?></i></b> <i> on </i><b><i><?php echo $model->approved_on; ?> </i></b> <br/>
    <b> <?php echo $model->approval_comments; ?></b>
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

<h3>Status History</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'modulestatus-grid',
	'dataProvider'=>  $statusDataProvider,
	//'filter'=>$model,
	'columns'=>array(
		/*'id',
		'job_id',
		'voucher_id',
		'bill_id',
		'payment_id',
		'receipt_id',
		*/
		'status',
		'comments',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
	),
)); ?>