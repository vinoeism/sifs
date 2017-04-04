<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->REFNO=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'View Job', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update <?php echo $model->REFNO; ?></h1>

<?php 
    if ($formName == 'ROUTING') { 
        echo $this->renderPartial('_routing', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider)); 
    } else if ($formName == 'DOCS') { 
        echo $this->renderPartial('_docs', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider));
    } else if ($formName == 'CARGO') { 
        echo $this->renderPartial('_cargo', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider));
    } else {
        echo $this->renderPartial('_form', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider)); 
    } 
?>
