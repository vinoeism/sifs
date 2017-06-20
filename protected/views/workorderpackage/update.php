<?php
/* @var $this WorkorderpackageController */
/* @var $model Workorderpackage */

$this->breadcrumbs=array(
	'Workorderpackages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Workorderpackage', 'url'=>array('index')),
//	array('label'=>'Create Workorderpackage', 'url'=>array('create')),
//	array('label'=>'View Workorderpackage', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Workorderpackage', 'url'=>array('admin')),
//);
?>

<h1>Update Workorderpackage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>