<?php
/* @var $this WorkorderpackageController */
/* @var $model Workorderpackage */

$this->breadcrumbs=array(
	'Workorderpackages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Workorderpackage', 'url'=>array('index')),
	array('label'=>'Manage Workorderpackage', 'url'=>array('admin')),
);
?>

<h1>Create Workorderpackage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>