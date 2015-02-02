<?php
/* @var $this VoucherController */
/* @var $model Voucher */

$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('create')),
	array('label'=>'View Voucher', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>

<h1>Reject <?php echo $model->voucher_type; ?> Voucher #<?php echo $model->id; ?> dtd. <?php echo $model->voucher_date; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
//		'voucher_date',
//		'branch_id',
//		'voucher_type',
//		'bill_id',
//		'job_id',
//		'employee_id',
//		'vehicle_id',
//		'asset_id',
		'towards',            
		'total_tax_1',
		'total_tax_2',
		'total_amount',
		'comments',
//		'passed_by',
//		'passed_on',
//		'passed_comments',
//		'approved_by',
//		'approved_on',
//		'approval_comments',
		'priority',

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moduledescription-grid',
	'dataProvider'=>$itemsDataProvider,
//	'filter'=>$model,
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
//                array(
//                        'class'=>'CLinkColumn',
//                        'label'=>'edit',
//                        'urlExpression'=>'Yii::app()->createUrl("moduledescription/update",array("id"=>$data->id))',
//                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
//                ),
//                array(
//                        'class'=>'CLinkColumn',
//                        'label'=>'delete',
//                        'urlExpression'=>'Yii::app()->createUrl("moduledescription/delete",array("id"=>$data->id))',
//                ),
	),
)); ?>


<?php echo $this->renderPartial('_reject', array('model'=>$model)); ?>