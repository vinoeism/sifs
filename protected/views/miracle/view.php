<?php
/* @var $this MiracleController */
/* @var $model Miracle */

$this->breadcrumbs=array(
	'Miracles'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Miracle', 'url'=>array('index')),
	array('label'=>'Create Miracle', 'url'=>array('create')),
	array('label'=>'Update Miracle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Add Prayer Request', 'url'=>array('createPrayerRequest')),
	array('label'=>'Add Testimony', 'url'=>array('createTestimony')),
);
?>

<h1>View Miracle #<?php echo $model->id; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'miracle_date',
		'miracle_type',
		'recepient',
		'prayer_request',
		'start_date',
		'end_date',
		'warriors',
		'testimony',
	),
)); ?>
