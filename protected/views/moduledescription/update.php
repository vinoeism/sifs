<?php
/* @var $this ModuledescriptionController */
/* @var $model Moduledescription */

$this->breadcrumbs=array(
	'Moduledescriptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Moduledescription', 'url'=>array('index')),
	array('label'=>'Create Moduledescription', 'url'=>array('create')),
	array('label'=>'View Moduledescription', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Moduledescription', 'url'=>array('admin')),
);
?>

<h1>Update Moduledescription <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>