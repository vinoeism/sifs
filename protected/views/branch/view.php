<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->branch_name,
);

$this->menu=array(
	//array('label'=>'List Branch', 'url'=>array('index')),
	//array('label'=>'Create Branch', 'url'=>array('create')),
	array('label'=>'Update Branch', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Branch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Branch', 'url'=>array('admin')),
        array('label'=>'Add Bank', 'url'=>array('bank/create', 'module'=> "BRANCH", 'moduleId'=>$model->id))
);
$this->sidemenu=array(
	//array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('voucher/create', 'branchID'=>$model->id)),
	array('label'=>'Create Receipt', 'url'=>array('receipt/create', 'branchID'=>$model->id)),
);
?>

<h1><?php echo $model->branch_name; ?></h1>
<img src="images/create.png" height="14px"> <?php echo User::model()->findByPK($model->created_by)->username; ?></i></b> <i> | </i><b><i> <?php echo $model->created_on; ?></i></b>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/update.png" height="14px"> <?php echo User::model()->findByPK($model->updated_by)->username; ?></i></b> <i> | </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
//		'branch_name',
		'branch_location',
                'branch_code',
//		'is_registered_office',
		'PAN_no',
		'ST_registration_no',
		'comments',
//		'created_by',
//		'created_on',
//		'updated_by',
//		'updated_on',
	),
)); ?>
<br/><br/>

<?php 
    //$data = Address::model()->getAddressForModule($model->id, 'BRANCH'); --$data->itemCount == 0
    if (empty($addressDataProvider) || $addressDataProvider->itemCount == 0)
    {
        ?>
            Create an address for the branch <?php echo CHtml::link('here',array('address/create', 'moduleid'=>$model->id, 'modulename'=>'BRANCH')); ?>...
        <?php
    } else {
        ?>
            <?php $this->widget('zii.widgets.CListView', array(
                   'dataProvider'=>  $addressDataProvider,
                   'itemView'=>'../address/_view',
           )); ?> 
            
        <?php 
    }
?>

<br/><br/>

<h3>Bank accounts <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('bank/create', 'module'=> "BRANCH", 'moduleId'=>$model->id)); ?></h3>

            
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bank-grid',
	'dataProvider'=>$bankDataProvider,
//	'filter'=>$model,
        'template' => '{items}{pager}',	
        'columns'=>array(
		/*'id',
		'party_id',
		'branch_id',
		'employee_id',*/
		array(
                        'name'=>'bank_name',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->bank_name), array(\'bank/update\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),            
		'bank_address',
		'account_no',
		'ifsc_code',
		'swift_code',
		//'comments',
		//'status',
            	array(
                    'name'=>'isActive',
                    'type'=>'raw',
                    'filter'=>'',
                    'htmlOptions'=>array('style' => 'text-align: center;'),
                    'value'=>'($data->isActive==1)?CHtml::image(\'images/active.png\',\'Yes\', array(\'height\'=>\'14px\')):CHtml::image(\'images/inactive.png\',\'Yes\', array(\'height\'=>\'14px\'))',   
                ),
	),
)); ?>
            
<br/><br/>

<h3>Ongoing Jobs <?php echo CHtml::link('<img src="images/add.png" height="14px" />', array('job/create')); ?></h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-grid',
        'dataProvider'=> $jobDataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
                array(
                        'name'=>'REFNO',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->REFNO), array(\'job/view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),            
		//'Client_REFNO',
		//'init_date',
		//'branch_id',
		//'quote_id',
                array(
                    'name' => 'client_search',
                    'value' => 'isset($data->clients)?$data->clients->party_name:"  -  "',
                ),
                /* array(
                    'name' => 'shipp_search',
                    'value' => 'isset($data->shippers)?$data->shippers->party_name:"  -  "',
                ),
                array(
                    'name' => 'conee_search',
                    'value' => 'isset($data->consignees)?$data->consignees->party_name:"  -  "',
                ),    
                
                array(
                    'name' => 'agnt_search',
                    'value' => 'isset($data->agents)?$data->agents->party_name:"  -  "',
                ),
            
                array(
                    'name' => 'transporter_search',
                    'value' => 'isset($data->transporters)?$data->transporters->party_name:"  -  "',
                ),   */         
		//'agent', 
		'cargo',
		//'packages',
		//'assessable_value',
		//'duty_value',
		//'duty_date',
		//'duty_mode',
		'type',
		'mode',
		'terms',
		//'gross_weight',
		//'gross_weight_unit',
		//'nett_weight',
		//'nett_weight_unit',
		//'chargeable_weight',
		//'chargeable_weight_unit',
		//'document_references',
		'origin',
		'destination',
		//'transhipment',
		//'carrier_name',
		//'voyage_no',
		//'pickup_date',
		//'stuffing_date',
		'BE_SB_no',
		'BE_SB_date',
		//'bond_no',
		//'bond_date',
		//'bond_comments',
		//'onboard_date',
		//'transhipment_arrival_date',
		//'transhipment_date',
		//'arrival_date',
		//'cfs_id',
		//'contr_nos',
		//'truck_nos',
		//'comments',
		//'enquiry_by',
		//'handled_by',
		//'created_by',
		//'created_on',
		//'updated_by',
		//'updated_on',
//            
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>
