<?php
/* @var $this JobeventController */
/* @var $model Jobevent */

$this->breadcrumbs=array(
	'Jobevents'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List Jobevent', 'url'=>array('index')),
//	array('label'=>'Manage Jobevent', 'url'=>array('admin')),
//);
?>

<h1><?php echo $eventModel->name; ?></h1>
<h5><?php echo $eventModel->description; ?></h5> <br/>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>