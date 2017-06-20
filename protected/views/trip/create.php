<?php
/* @var $this TripController */
/* @var $model Trip */

$this->breadcrumbs=array(
	'Trips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Trip', 'url'=>array('index')),
	array('label'=>'Manage Trip', 'url'=>array('admin')),
);
?>

<h1>Create Trip</h1>

<?php 
if (empty($model->transporter_id)) {
    echo $this->renderPartial('_ownform', array('model'=>$model)); 
} else {
    echo $this->renderPartial('_rentalform', array('model'=>$model)); 
}

?>