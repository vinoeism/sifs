<?php
/* @var $this TripController */
/* @var $model Trip */

$this->breadcrumbs=array(
	'Trips'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Trip', 'url'=>array('index')),
//	array('label'=>'Create Trip', 'url'=>array('create')),
//	array('label'=>'View Trip', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Trip', 'url'=>array('admin')),
//);
?>
<div class="form">

    <h1>Add/Remove Jobs to Trip <?php echo $model->id; ?></h1>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'addjobs-form',
            'enableAjaxValidation'=>false,
    )); ?>  
        <h3>Select Jobs to Add</h3>

        <?php  $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'package-grid',
                'dataProvider'=>$addJobsDataProvider,
                'columns'=>array(
                        array(
                            'name' => 'check',
                            'id' => 'addJobs',
                            'value' => '$data->id',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '100',
                        ),
                        array(
                                'name'=>'client',
                                'type'=>'raw',
                                'filter'=>'',
                                'value'=>'$data->client_id',
                                //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                        ),
                        array(
                            'name'=> "From",
                            'value' => '$data->origin',	
                        ),		            
                        array(
                          'name'=> 'To',
                            'value' => 	'$data->destination'
                        ),
                        'cargo',
                ),
                'summaryText' => '', 
        )); 
        ?>

        <h3>Select Jobs to remove</h3>

        <?php  $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'package-grid',
                'dataProvider'=>$removeJobsDataProvider,
                'columns'=>array(
                        array(
                            'name' => 'check',
                            'id' => 'removeJobs',
                            'value' => '$data->id',
                            'class' => 'CCheckBoxColumn',
                            'selectableRows' => '100',
                        ),
                        array(
                                'name'=>'client',
                                'type'=>'raw',
                                'filter'=>'',
                                'value'=>'$data->client_id',
                                //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                        ),
                        array(
                            'name'=> "From",
                            'value' => '$data->origin',	
                        ),		            
                        array(
                          'name'=> 'To',
                            'value' => 	'$data->destination'
                        ),
                        'cargo',
                ),
                'summaryText' => '', 
        )); 

        ?>

        <div class="row buttons">
                <?php echo CHtml::submitButton('Add/remove selected jobs'); ?>
        </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->