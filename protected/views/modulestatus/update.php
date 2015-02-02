<?php
/* @var $this ModulestatusController */
/* @var $model Modulestatus */

$this->breadcrumbs=array(
	'Modulestatuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Modulestatus', 'url'=>array('index')),
	array('label'=>'Create Modulestatus', 'url'=>array('create')),
	array('label'=>'View Modulestatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Modulestatus', 'url'=>array('admin')),
);
?>

<h1>Update Modulestatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>