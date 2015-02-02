<?php
/* @var $this PartyController */
/* @var $model Party */

$this->breadcrumbs=array(
	'Parties'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Party', 'url'=>array('index')),
	//array('label'=>'Manage Party', 'url'=>array('admin')),
);
?>

<h1>Create Party</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>