<?php
/* @var $this WorkorderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Workorders',
);

$this->menu=array(
	array('label'=>'Create Workorder', 'url'=>array('create')),
	array('label'=>'Manage Workorder', 'url'=>array('admin')),
);
?>

<h1>Workorders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
