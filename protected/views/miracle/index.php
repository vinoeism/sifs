<?php
/* @var $this MiracleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Miracles',
);

$this->menu=array(
	array('label'=>'Create Miracle', 'url'=>array('create')),
	array('label'=>'Manage Miracle', 'url'=>array('admin')),
);
?>

<h1>Miracles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
