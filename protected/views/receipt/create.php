<?php
/* @var $this ReceiptController */
/* @var $model Receipt */

$this->breadcrumbs=array(
	'Receipts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Receipt', 'url'=>array('index')),
	array('label'=>'Manage Receipt', 'url'=>array('admin')),
);
?>

<h1>Create Receipt</h1>

<?php if ($receiptMode == 'INVOICE') {?>
    <?php echo $this->renderPartial('_receive', array('model'=>$model, 'invoiceDataProvider'=>$invoiceDataProvider)); ?>
<?php } else { ?>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php } ?>
 