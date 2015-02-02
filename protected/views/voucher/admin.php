<?php
/* @var $this VoucherController */
/* @var $model Voucher */

$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Unpaid Vouchers', 'url'=>array('index')),
        array('label'=>'Paid Vouchers', 'url'=>array('paidVouchers')),
        array('label'=>'Payments', 'url'=>array('payment/index')),
);
$this->sidemenu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Create Voucher', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#voucher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Unpaid Vouchers</h1>

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
	'id'=>'voucher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'id',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
		'voucher_date',
                array(
                    'name'=>'pay_to',
                    'filter'=>$model->getPayeeOptions(),
                    'value'=>'isset($data->parties)?$data->parties->party_name:"  -  "',
                ),
                array(
                    'name'=>'voucher_type',
                    'filter'=>$model->getTypeOptions(),
                ),
		'towards',            
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
                ),
                
		//'bill_id',
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
		//array(
		//	'class'=>'CButtonColumn',
		//),

//                array(
//                        'class'=>'CLinkColumn',
//                        'label'=>'pass',
//                        'urlExpression'=>'(isset($data->passed_by) || !(isset($data->total_amount)))?"#":Yii::app()->createUrl("voucher/pass",array("id"=>$data->id))',
//                ), 
//                array(
//                        'class'=>'CLinkColumn',
//                        'label'=>'approve',
//                        'urlExpression'=>'(isset($data->approved_by) || !(isset($data->total_amount)))?"#":Yii::app()->createUrl("voucher/approve",array("id"=>$data->id))',
//                ),  
                array(
                        'class'=>'CLinkColumn',
                        'label'=>'reject',
                        'urlExpression'=>'Yii::app()->createUrl("voucher/reject",array("id"=>$data->id))',
                ),    
                array(
                        'class'=>'CLinkColumn',
                        'label'=>'pay',
                        'urlExpression'=>'Yii::app()->createUrl("voucher/pay",array("id"=>$data->id))',
                ),             
            
//                'links'=>array(
//                    'header'=>'Manage',
//                    'type'=>'raw',
//                    'value'=>'CHtml::link(
//                                  CHtml::image(Yii::app()->request->baseUrl."/images/admin/approve.png","Pass"), 
//                                  array(
//                                      "approve",
//                                      "id"=>$data->business_id,
//                                      "item"=>"business"
//                                  ),
//                                  array(
//                                      "class"=>"approve-link",
//                                      "title"=>"Approve Business"
//                                  )
//                              )." ".
//                              CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/admin/reject.png","Approve"), array("reject","id"=>$data->business_id,"item"=>"business"),array("class"=>"reject-link","title"=>"Reject Business"))',
//                ),

	),
)); ?>
