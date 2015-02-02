<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);

?>

<h1><?php echo $paymentMode; ?> Payment</h1>
<?php if ($paymentMode == 'CASH') {?>
    <?php echo $this->renderPartial('_cash', array('model'=>$model, 'voucherDataProvider'=>$voucherDataProvider)); ?>
<?php } else if ($paymentMode == 'CHEQUE') { ?>
    <?php echo $this->renderPartial('_cheque', array('model'=>$model, 'voucherDataProvider'=>$voucherDataProvider)); ?>
<?php } else if ($paymentMode == 'TRANSFER') { ?>
    <?php echo $this->renderPartial('_transfer', array('model'=>$model, 'voucherDataProvider'=>$voucherDataProvider)); ?>
<?php } ?>

</div>