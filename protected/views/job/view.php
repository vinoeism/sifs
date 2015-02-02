<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'Update Job', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Job', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);

$this->sidemenu=array(
        array('label'=>'Add Status', 'url'=>array('modulestatus/create','moduleid'=>$model->id, 'modulename'=>"JOB")),
        array('label'=>'Add Task', 'url'=>array('task/create','jobID'=>$model->id)),
        array('label'=>'Add Voucher', 'url'=>array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
);

?>

<h1><?php echo $model->branches->branch_name.'    '.$model->type.' / '.$model->mode.' :: '.$model->REFNO; ?></h1>
<h3>Initiated on <?php echo $model->init_date; ?> </h3>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Client_REFNO',
                array(
                    'name' => 'client_id',
                    'value' => CHtml::encode(isset($model->clients)?$model->clients->party_name:"Not set"),
                ),
                array(
                    'name' => 'shipper',
                    'value' => CHtml::encode(isset($model->shippers)?$model->shippers->party_name:"Not set"),
                ),
                array(
                    'name' => 'consignee',
                    'value' => CHtml::encode(isset($model->consignees)?$model->consignees->party_name:"Not set"),
                ),
                array(
                    'name' => 'agent',
                    'value' => CHtml::encode(isset($model->agents)?$model->agents->party_name:"Not set"),
                ),
                array(
                    'name' => 'cfs_id',
                    'value' => CHtml::encode(isset($model->cfses)?$model->cfses->party_name:"Not set"),
                ), 
                array(
                    'name' => 'transporter',
                    'value' => CHtml::encode(isset($model->transporters)?$model->transporters->party_name:"Not set"),
                ),            

		'enquiry_by',
		'handled_by',
	),
)); ?>
<br><h3>Cargo details </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cargo',
		'packages',
		'assessable_value',
		'duty_value',
		'duty_date',
		'duty_mode',
		'terms',
                array(
                  'name'=> 'gross_weight',
                    'value' => 	$model->gross_weight.' '.$model->gross_weight_unit,
		
                ),
                array(
                  'name'=> 'nett_weight',
                    'value' => 	$model->nett_weight.' '.$model->nett_weight_unit,
		
                ),
                array(
                  'name'=> 'chargeable_weight',
                    'value' => 	$model->chargeable_weight.' '.$model->chargeable_weight_unit,
		
                ),
		'document_references',
	),
)); ?>
<br><h3>Shipment details </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'origin',
		'destination',
		'transhipment',
                array(
                  'name'=> 'carrier_name',
                    'value' => 	$model->carrier_name.' '.$model->voyage_no,
		
                ),
		'pickup_date',
		'stuffing_date',
                array(
                  'name'=> 'BE_SB_no',
                    'value' => 	$model->BE_SB_no.' dtd '.$model->BE_SB_date,
		
                ),
                array(
                  'name'=> 'bond_no',
                    'value' => 	$model->bond_no.' dtd '.$model->bond_date,
		
                ),	
		'bond_comments',
		'onboard_date',
		'transhipment_arrival_date',
		'transhipment_date',
		'arrival_date',
		//'cfs_id',
		'contr_nos',
		'truck_nos',
		'comments',
    ),
)); ?>
<br/><br/>

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

<h3>Ongoing tasks</h3>

<?php 
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>  $tasksDataProvider,
            'itemView'=>'../task/_view',
    )); ?> 

    <br/>Add a task for the job <?php echo CHtml::link('here',array('task/create', 'jobID'=>$model->id)); ?>...

    <br/><br/>
<h3>Vouchers</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'voucher-grid',
	'dataProvider'=>$voucherDataProvider,
//	'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'id',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'voucher/view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
		'voucher_date',
		//'branch_id',
		'voucher_type',
		'towards',            
		'total_tax_1',
                'total_tax_2',            
		'total_amount',
		array(
                    'name'=>'passed_by',
                    'type'=>'raw',
                    'filter'=>CHtml::listData(User::model()->findAll(array('order'=>'username')),'id','username'),
                    'value'=>'isset($data->passers)?$data->passers->username:CHtml::link(CHtml::encode("pass"), array(\'pass\', \'id\'=>$data->id))',   
                ),
		array(
                    'name'=>'approved_by',
                    'type'=>'raw',
                    'filter'=>CHtml::listData(User::model()->findAll(array('order'=>'username')),'id','username'),
                    'value'=>'isset($data->approvers)?$data->approvers->username:(isset($data->rejecters)?CHtml::link(CHtml::encode("reconsider"), array(\'approve\', \'id\'=>$data->id)):CHtml::link(CHtml::encode("approve"), array(\'approve\', \'id\'=>$data->id)))',   
                ),		//'bill_id',
		//'job_id',
		/*
		'employee_id',
		'vehicle_id',
		'asset_id',
		'total_serv_tax',
		'total_edu_cess',
		'total_sur_edu_cess',

		'comments',
		'passed_on',
		'passed_amount',
		'passed_comments',
		'approved_on',
		'approved_amount',
		'approval_comments',
		'priority',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
		*/
	),
)); ?>

Add a voucher for the job <?php echo CHtml::link('here',array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)); ?>...

<br/><br/>
<h3>Invoices</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider'=>$invoiceDataProvider,
//	'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'id',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'invoice/view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
		'REFNO',
		//'branch_id',
		//'job_id',
		'invoice_date',
            	array(
                    'name'=>'party_id',
                    'type'=>'raw',
                    'filter'=>'',
                    'value'=>'isset($data->parties)?$data->parties->party_name:"N/A"',   
                ),
                //'invoice_terms',
		'total_tax_1',
		'total_tax_2',
		'total_amount',
		/*'created_by',
		'created_on',
		'updated_by',
		'updated_on',
		'approved_by',
		'approved_on',
		'approval_comments',*/
		'due_on',
		'status',
		/*'status_date',
		'is_active',
		*/

	),
)); ?>

Add an invoice for the job <?php echo CHtml::link('here',array('invoice/create', 'jobId'=>$model->id, 'branchId'=>$model->branch_id)); ?>...


