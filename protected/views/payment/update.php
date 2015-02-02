<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
	array('label'=>'View Payment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Payment', 'url'=>array('admin')),
);
?>

<h1>Update <?php echo $paymentmode; ?> Payment <?php echo $model->id; ?></h1>
<?php if ($paymentmode == 'CASH') {?>
    <?php echo $this->renderPartial('_cash', array('model'=>$model)); ?>
<?php } else if ($paymentmode == 'CHEQUE') { ?>
    <?php echo $this->renderPartial('_cheque', array('model'=>$model)); ?>
<?php } else if ($paymentmode == 'TRANSFER') { ?>
    <?php echo $this->renderPartial('_transfer', array('model'=>$model)); ?>
<?php } ?>