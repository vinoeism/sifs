<?php
/* @var $this ModulestatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Modulestatuses',
);

$this->menu=array(
	array('label'=>'Create Modulestatus', 'url'=>array('create')),
	array('label'=>'Manage Modulestatus', 'url'=>array('admin')),
);
?>

<h1>Modulestatuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
