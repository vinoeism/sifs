<?php
/* @var $this JobeventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jobevents',
);

$this->menu=array(
	array('label'=>'Create Jobevent', 'url'=>array('create')),
	array('label'=>'Manage Jobevent', 'url'=>array('admin')),
);
?>

<h1>Jobevents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
