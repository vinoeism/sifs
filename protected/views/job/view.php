<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->REFNO,
);

$this->menu=array(
	//array('label'=>'List Job', 'url'=>array('index')),
	//array('label'=>'Create New Job', 'url'=>array('create')),
        //array('label'=>'Update '.$model->REFNO, 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Update Routing details', 'url'=>array('update', 'id'=>$model->id, 'formName'=>'ROUTING')),
        array('label'=>'Update Docs details', 'url'=>array('update', 'id'=>$model->id, 'formName'=>'DOCS')),
//        array('label'=>'Send Mail', 'url'=>array('job/SendMail','id'=>$model->id)),
//	array('label'=>'Delete '.$model->REFNO, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

if ($model->mode == 'SEA FCL') {
    $this->sidemenu = array(
//            array('label'=>'Update Cargo details', 'url'=>array('update', 'id'=>$model->id, 'formName'=>'CARGO')),    
        array('label'=>'Add Contr details', 'url'=>array('package/create', 'jobID'=>$model->id, 'formName'=>'CONTR')),            
        array('label'=>'Add Status', 'url'=>array('modulestatus/create','moduleid'=>$model->id, 'modulename'=>"JOB")),
        array('label'=>'Add Task', 'url'=>array('task/create','jobID'=>$model->id)), 
        array('label'=>'Add Voucher', 'url'=>array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
        array('label'=>'Add Invoice', 'url'=>array('invoice/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
    );
} else {
    $this->sidemenu = array(
//	array('label'=>'Update Cargo details', 'url'=>array('update', 'id'=>$model->id, 'formName'=>'CARGO')),    
        array('label'=>'Add Packages', 'url'=>array('package/create', 'jobID'=>$model->id, 'formName'=>'PKG')),            
        array('label'=>'Add Voucher', 'url'=>array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
        array('label'=>'Add Invoice', 'url'=>array('invoice/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)),
);
}
array_push($this->menu, array('label'=>'Add WorkOrder', 'url'=>array('workorder/create','jobID'=>$model->id))); 
?>

<h1><?php echo $model->type.' / '.$model->mode; ?><?php echo "   ".CHtml::link('<img src="images/update.png" height="18px" />', array('update', 'id'=>$model->id)); ?></h1>
<img src="images/create.png" height="14px"> <?php echo User::model()->findByPK($model->created_by)->username; ?></i></b> <i> | </i><b><i> <?php echo $model->created_on; ?></i></b>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/update.png" height="14px"> <?php echo User::model()->findByPK($model->updated_by)->username; ?></i></b> <i> | </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>
<i><mark>Initiated on <?php echo $model->init_date; ?> at <?php echo $model->branches->branch_name; ?></mark> </i><br/>

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
                array(
                    'name' => 'enquiry_by',
                    'value' => CHtml::encode(isset($model->enquiry_by)?User::model()->findbyPk($model->enquiry_by)->username:"Not set"),
                ), 
                array(
                    'name' => 'handled_by',
                    'value' => CHtml::encode(isset($model->handled_by)?User::model()->findbyPk($model->handled_by)->username:"Not set"),
                ), 
	),
)); ?>
<br><h3>Cargo details </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'cargo',
		'packages',
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
                    'value' => CHtml::encode(isset($model->chargeable_weight)?$model->chargeable_weight.' '.$model->chargeable_weight_unit:"Not set"),
		
                ),
	),
)); ?>

<?php if ($model->mode == 'SEA FCL') {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$contrsDataProvider,
	'columns'=>array(
                array(
                        'name'=>'name',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->name), array(\'package/update\', \'id\'=>$data->id, \'formName\'=>\'CONTR\'))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                    'name'=> "Contr Type",
                    'value' => '$data->subtype',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                'cargo',
//                array(
//                        'name'=>'Arrange Vehicle',
//                        'type'=>'raw',
//                        'filter'=>'',
//                        'value'=>'CHtml::link(CHtml::encode("Existing Trip"), array(\'trip/create\', \'packageID\'=>$data->id, \'formName\'=>\'ADD\' ))." / ".CHtml::link(CHtml::encode("New Trip"), array(\'trip/create\', \'packageID\'=>$data->id, \'formName\'=>\'NEW\' ))',
//                ),            
        ),
        'summaryText' => '', 
)); } else {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$contrsDataProvider,
	'columns'=>array(
                array(
                        'name'=>'cargo',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->cargo), array(\'package/update\', \'id\'=>$data->id, \'formName\'=>\'PKG\'))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                    'name'=> "Dimensions",
                    'value' => '$data->length." x ".$data->breadth." x ".$data->height." ".$data->dimension_unit',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'chargeable_weight',
                    'value' => 	'$data->chargeable_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'quantity',
                    'value' => 	'$data->quantity." ".$data->subtype." ".$data->type'
                ),   
//                array(
//                        'name'=>'Vehicle',
//                        'type'=>'raw',
//                        'filter'=>'',
//                        'value'=>'CHtml::link(CHtml::encode("Existing"), array(\'trip/create\', \'packageID\'=>$data->id ))."/".CHtml::link(CHtml::encode("New"), array(\'trip/create\', \'packageID\'=>$data->id ))',
//                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
//                ),            
            
            
        ),
        'summaryText' => '', 
)); } 
?>

<h3>Events <?php echo $eventDataProvider == null?"":CHtml::link('<img src="images/add.png" height="14px" />', array('jobevent/create','jobID'=>$model->id, 'eventID'=>$eventDataProvider->id)); ?> </h3>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$jobEventDataProvider,
	'columns'=>array(
                array(
                        'name'=>'Event',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->events->name), array(\'jobevent/update\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                    'name'=> "Description",
                    'value' => '$data->events->description',	
                ),
                array(
                    'name'=> "Event Date",
                    'value' => '$data->event_date',	
                ),
                 array(
                    'name'=> "Comments",
                    'value' => '$data->comments',	
                ),
            ),
        'summaryText' => '', 
    )); 
?>



<h3>Work Orders <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('workorder/create','jobID'=>$model->id)); ?> </h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$woDataProvider,
	'columns'=>array(
                array(
                        'name'=>'WO ID',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'workorder/update\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                    'name'=> "WO Date",
                    'value' => '$data->wo_date',	
                ),
                array(
                    'name'=> "Vehicle Type",
                    'value' => 'isset($data->vehicle_type)?Settings::model()->findByPk($data->vehicle_type)->setting_value:"NA"',	
                ),
                array(
                    'name'=> "Trip Type",
                    'value' => 'isset($data->trip_type)?Settings::model()->findByPk($data->trip_type)->setting_value:"NA"',	
                ),		            
                array(
                  'name'=> 'From',
                    'value' => 	'$data->from_location'
                ),
                array(
                  'name'=> 'To',
                    'value' => 	'$data->to_location'
                ),
                array(
                  'name'=> 'Transporter',
                    'value' => 	'CHtml::encode(isset($data->transporters)?$data->transporters->party_name:"Not set")',
                ),  
                array(
                        'name'=>'Packages',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link("edit", array(\'workorder/editPackages\', \'job_id\'=>'.$model->id.',\'wo_id\'=>$data->id))',
                        'htmlOptions'=>array('style'=>'text-align:center;')
                ),            
                array(
                        'name'=>'Voucher',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link("create", array(\'voucher/create\', \'branchID\'=>'.$model->branch_id.', \'jobID\'=>'.$model->id.',\'woID\'=>$data->id))',
                        'htmlOptions'=>array('style'=>'text-align:center;')
                ), 
            array(
                        'name'=>'',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link("<img src=\'images/pdf.png\' height=\'14px\'", array(\'workorder/generateTransportWO\', \'id\'=>$data->id),array(\'target\'=>\'_blank\'))',
                        'htmlOptions'=>array('style'=>'text-align:center;')
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                        'name'=>'',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link("<img src=\'images/mail.png\' height=\'14px\'", array(\'workorder/sendMail\', \'id\'=>$data->id))',
                        'htmlOptions'=>array('style'=>'text-align:center;')
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),            
            ),
        'summaryText' => '', 
)); 
?>
<br><h3>Routing details <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('update', 'id'=>$model->id, 'formName'=>'ROUTING')); ?></h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'origin',
		'destination',
		'transhipment',
		'assessable_value',
		'duty_value',
		'duty_date',
		'duty_mode',
		'terms',            
                array(
                  'name'=> 'liner_carrier_name',
                    'value' => 	$model->liner_carrier_name.' '.$model->voyage_no,
		
                ),
		'pickup_date',
		'stuffing_date',
		'onboard_date',
		'transhipment_arrival_date',
		'transhipment_date',
		'arrival_date',   
                array(
                  'name'=> 'mbl_mawb_no',
                    'value' => 	CHtml::encode(isset($model->mbl_mawb_no)?$model->mbl_mawb_no.' dtd '.$model->mbl_mawb_date:''),
                    'visible' => CHtml::encode(isset($model->mbl_mawb_no)?true:false),
		
                ),            
                array(
                  'name'=> 'hbl_hawb_no',
                    'value' => 	CHtml::encode(isset($model->hbl_hawb_no)?$model->hbl_hawb_no.' dtd '.$model->hbl_hawb_date:''),
                    'visible' => CHtml::encode(isset($model->hbl_hawb_no)?true:false),
                ), 
                array(
                  'name'=> 'BE_SB_no',
                    'value' => 	$model->BE_SB_no.' dtd '.$model->BE_SB_date,
	            'visible' => CHtml::encode(isset($model->BE_SB_no)?true:false),	
                ),
                array(
                  'name'=> 'bond_no',
                    'value' => 	CHtml::encode(isset($model->bond_no)?$model->bond_no.' dtd '.$model->bond_date:''),
                    'visible' => CHtml::encode(isset($model->bond_no)?true:false),
                ),	
                array(
                  'name'=> 'bond_comments',
                    'value' => 	CHtml::encode(isset($model->bond_comments)?$model->bond_comments:''),
                    'visible' => CHtml::encode(isset($model->bond_no)?true:false),
                ),

		//'cfs_id',
		'truck_nos',
                array(
                  'name'=> 'comments',
                    'value' => 	CHtml::encode(isset($model->comments)?$model->comments:''),
                    'visible' => CHtml::encode(isset($model->comments)?true:false),
                ),    ),
)); ?>
<br/><br/>

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
        'summaryText' => '',     
)); ?>

<h3>Ongoing tasks <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('task/create', 'jobID'=>$model->id)); ?></h3>

<?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>  $tasksDataProvider,
            'itemView'=>'../task/_view',
    )); ?> 


    <br/><br/>
<h3>Vouchers <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('voucher/create', 'jobID'=>$model->id, 'branchID'=>$model->branch_id)); ?></h3>

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
                'total_tax_3',            
                'total_tax_4',            
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


<br/><br/>
<h3>Invoices <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('invoice/create', 'jobId'=>$model->id, 'branchId'=>$model->branch_id)); ?></h3>
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
		'total_tax_3',
		'total_tax_4',
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


