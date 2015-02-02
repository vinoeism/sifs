<?php
/* @var $this TaskController */
/* @var $model Task */

//$this->breadcrumbs=array(
//	'Tasks'=>array('index'),
//	'Transfer',
//);
//
//$this->menu=array(
//	array('label'=>'List Task', 'url'=>array('index')),
//	array('label'=>'Manage Task', 'url'=>array('admin')),
//);
?>

<h1>Transfer Task</h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'job_id',
		'description',
		'comments',
		'owner_id',
		'allotted_by',
		'allotted_to',
		'due_date',
		'status',
		'priority',
	),
)); ?>


<?php echo $this->renderPartial('_transfer', array('model'=>$model)); ?>