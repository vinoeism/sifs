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
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
if (!isset($model->passed_by)){
    $this->sidemenu=array(
        array('label'=>'Pass Voucher', 'url'=>array('pass', 'id'=>$model->id)),
        array('label'=>'Approve Voucher', 'url'=>array('approve', 'id'=>$model->id)),
    );
            
} else if (!isset($model->approved_by)) {
    $this->sidemenu=array(
        array('label'=>'Approve Voucher', 'url'=>array('approve', 'id'=>$model->id)),
    );    
}


?>

<h1>Update Voucher <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider,'expensesDataProvider'=>$expensesDataProvider)); ?>