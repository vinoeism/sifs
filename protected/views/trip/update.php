<?php
/* @var $this TripController */
/* @var $model Trip */

$this->breadcrumbs=array(
	'Trips'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Trip', 'url'=>array('index')),
	array('label'=>'Create Trip', 'url'=>array('create')),
	array('label'=>'View Trip', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Trip', 'url'=>array('admin')),
        array('label'=>'Add jobs', 'url'=>array('addjobs', 'id'=>$model->id)),
);
?>

<h1>Update Trip <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_ownform', array('model'=>$model)); ?>