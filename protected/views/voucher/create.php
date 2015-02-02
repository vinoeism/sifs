<?php
/* @var $this VoucherController */
/* @var $model Voucher */

$this->breadcrumbs=array(
	'Vouchers'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Voucher', 'url'=>array('index')),
	array('label'=>'Manage Voucher', 'url'=>array('admin')),
);
?>

<h1>Create Voucher</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider,'expensesDataProvider'=>$expensesDataProvider)); ?>