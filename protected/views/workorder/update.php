<?php
/* @var $this WorkorderController */
/* @var $model Workorder */

$this->breadcrumbs=array(
	'Workorders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Workorder', 'url'=>array('index')),
	array('label'=>'Edit Packages', 'url'=>array('view')),
//	array('label'=>'Delete Workorder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Update Workorder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>