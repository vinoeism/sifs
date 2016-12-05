<?php
/* @var $this PackageController */
/* @var $model Package */

$this->breadcrumbs=array(
	'Jobs'=>array('job/index'),
        $model->jobs->REFNO=>array('job/view','id'=>$model->job_id),
	'Package',
);


?>

<?php if ($formName == 'CONTR') { ?>
    <?php echo $this->renderPartial('_form_contr', array('model'=>$model)); ?>
<?php } else { ?>
    <?php echo $this->renderPartial('_form_pkg', array('model'=>$model)); ?>
<?php } ?>
