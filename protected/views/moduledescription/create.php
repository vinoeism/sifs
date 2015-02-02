<?php
/* @var $this ModuledescriptionController */
/* @var $model Moduledescription */

$this->breadcrumbs=array(
	'Moduledescriptions'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Moduledescription', 'url'=>array('index')),
	array('label'=>'Manage Moduledescription', 'url'=>array('admin')),
);
?>

<h1>Create item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>