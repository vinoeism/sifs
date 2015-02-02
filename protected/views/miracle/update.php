<?php
/* @var $this MiracleController */
/* @var $model Miracle */

$this->breadcrumbs=array(
	'Miracles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Miracle', 'url'=>array('index')),
	array('label'=>'Create Miracle', 'url'=>array('create')),
	array('label'=>'View Miracle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Miracle', 'url'=>array('admin')),
);
?>

<h1>Update Miracle <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>