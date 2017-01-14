<?php
/* @var $this WorkorderController */
/* @var $model Workorder */

$this->breadcrumbs=array(
	'Workorders'=>array('index'),
	'Create',
);

?>

<h1>Create Workorder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>