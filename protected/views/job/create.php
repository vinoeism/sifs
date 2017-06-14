<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Job', 'url'=>array('index')),
	//array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Create <?php echo $model->type; ?> Job</h1>
<?php if ($model->type == 'DOMESTIC') 
            echo $this->renderPartial('_trip', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider)); 
      else
            echo $this->renderPartial('_form', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider));           
?>