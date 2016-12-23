<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Jobs'=>array('job/index'),
        $model->jobs->REFNO=>array('job/view','id'=>$model->job_id),
	'Package',
);

$this->menu=array(
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this ?')),
	//array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<?php if ($formName == 'CONTR') { ?>
    <?php echo $this->renderPartial('_form_contr', array('model'=>$model)); ?>
<?php } else { ?>
    <?php echo $this->renderPartial('_form_pkg', array('model'=>$model)); ?>
<?php } ?>