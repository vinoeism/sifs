<?php
/* @var $this WorkorderpackageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Workorderpackages',
);

$this->menu=array(
	array('label'=>'Create Workorderpackage', 'url'=>array('create')),
	array('label'=>'Manage Workorderpackage', 'url'=>array('admin')),
);
?>

<h1>Workorderpackages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
