<?php
/* @var $this MiracleController */
/* @var $model Miracle */

$this->breadcrumbs=array(
	'Miracles'=>array('index'),
	'Create',
);

?>


<?php if (isset($reqtype) && ($reqtype == 'PRAYER')) { ?>
    <h1>Request a prayer </h1>
    <?php echo $this->renderPartial('_prayer',array('model'=>$model)); ?>
<?php } elseif (isset($reqtype) && ($reqtype == 'TESTIMONY')) { ?>
    <h1>Testify</h1>
    <?php echo $this->renderPartial('_testimony',array('model'=>$model)); ?>
<?php } else {?>
    <h1>Create Miracle</h1>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php } ?>