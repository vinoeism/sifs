<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->REFNO=>array('view','id'=>$model->id),
	'Update',
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
        if ($model->type == 'DOMESTIC') 
            echo $this->renderPartial('_trip', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider)); 
        else
            echo $this->renderPartial('_form', array('model'=>$model,'branchesDataProvider'=>$branchesDataProvider));      
    }         

?>
