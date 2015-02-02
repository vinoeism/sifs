<?php
/* @var $this TaskController */
/* @var $model Task */

//$this->breadcrumbs=array(
//	'Tasks'=>array('index'),
//	$model->id,
//);
if ($model->status == Task::STATUS_CLOSED) {
    $this->menu=array(
            //array('label'=>'List Task', 'url'=>array('index')),
            array('label'=>'Create Task', 'url'=>array('create')),
            //array('label'=>'Update Task', 'url'=>array('update', 'id'=>$model->id)),
            //array('label'=>'Delete Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
            //array('label'=>'Manage Task', 'url'=>array('admin')),
            array('label'=>'Reopen Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('reopen', 'id'=>$model->id),'confirm'=>'Do you really want to re-open this task?')),
    );    
} else {
    $this->menu=array(
            //array('label'=>'List Task', 'url'=>array('index')),
            array('label'=>'Create Task', 'url'=>array('create')),
            array('label'=>'Update Task', 'url'=>array('update', 'id'=>$model->id)),
            array('label'=>'Delete Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
            //array('label'=>'Manage Task', 'url'=>array('admin')),
            array('label'=>'Transfer Task', 'url'=>array('transfer', 'id'=>$model->id)),
            array('label'=>'Complete Task', 'url'=>array('complete', 'id'=>$model->id)),
            array('label'=>'Close Task', 'url'=>array('close', 'id'=>$model->id)),

    );
}

//$this->beginWidget('application.extensions.rightsidebar.RightSidebar', array('title' => 'Menu', 'collapsed' => true));
// 
//$this->widget('zii.widgets.CMenu', array(
//    'items' => array(
//        array('label' => 'Home', 'url' => array('site/index')),
//        array('label' => 'Products', 'url' => array('product/index'), 'items' => array(
//                array('label' => 'New Arrivals', 'url' => array('product/new')),
//                array('label' => 'Most Popular', 'url' => array('product/popular')),
//        )),
//    ),
//));
// 
//$this->endWidget();
?>

<h1>View Task #<?php echo $model->id; ?></h1>
<i>Created by</i><b><i> <?php echo $model->created_by; ?></i></b> <i>on</i><b><i> <?php echo $model->created_on; ?></i></b> <br/>
<i>Last updated by</i><b><i> <?php echo $model->updated_by; ?></i></b> <i> on </i><b><i><?php echo $model->updated_on; ?> </i></b> <br/><br/>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'job_id',
		'description',
		'comments',
		'owner_id',
		'allotted_by',
		'allotted_to',
		'due_date',
		'status',
		'priority',
		'transferred_to',
		'transfer_reason',
		'completed_on',
		'complete_comments',
		'rating',
		'closed_on',
		'closure_comments',
	),
)); ?>
