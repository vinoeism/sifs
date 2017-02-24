<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->branch_code=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'View Branch', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update <?php echo $model->branch_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'banksDataProvider' => $banksDataProvider)); ?>