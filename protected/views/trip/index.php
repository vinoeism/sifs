<?php
/* @var $this TripController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trips',
);
$this->menu=array(
	array('label'=>'Own Vehicles', 'url'=>array('create')),
	array('label'=>'Rental Vehicles', 'url'=>array('admin')),
);

$this->sidemenu=array(
	array('label'=>'Create Trip', 'url'=>array('create')),
	array('label'=>'Manage Trip', 'url'=>array('admin')),
);
?>

<h1>Trips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
