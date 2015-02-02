<?php
/* @var $this ModuledescriptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Moduledescriptions',
);

$this->menu=array(
	array('label'=>'Create Moduledescription', 'url'=>array('create')),
	array('label'=>'Manage Moduledescription', 'url'=>array('admin')),
);
?>

<h1>Moduledescriptions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
