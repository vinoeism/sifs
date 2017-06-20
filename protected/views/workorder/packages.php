<?php
/* @var $this WorkorderController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Workorders'=>array('index'),
	'Edit Packages',
);

$this->menu=array(
//	array('label'=>'List Workorder', 'url'=>array('index')),
//	array('label'=>'Create Workorder', 'url'=>array('create')),
);

?>

 
<div class="form">

    <h1>Workorder Packages</h1>

    <h3> Select packages to remove from work order</h3>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'packages-form',
            'enableAjaxValidation'=>false,
    )); ?>    
    <?php if ($model->mode == 'SEA FCL') {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$existingPackagesDataProvider,
	'columns'=>array(
                array(
                    'name' => 'check',
                    'id' => 'removedContrs',
                    'value'=>'$data->id',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '100',
                ),
                array(
                        'name'=>'name',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->name), array(\'workorderpackage/update\', \'package_id\'=>$data->id, \'job_id\'=>'.$model->id.',\'wo_id\'=>'.$wo_id.'))',
                ),
                array(
                    'name'=> "Contr Type",
                    'value' => '$data->subtype',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                'cargo',
        ),
        'summaryText' => '', 
)); } else {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$existingPackagesDataProvider,
	'columns'=>array(
                array(
                    'name' => 'check',
                    'id' => 'removedPackages',
                    'value' => '$data->id',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '100',
                ),
                array(
                        'name'=>'cargo',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->cargo), array(\'workorderpackage/update\', \'package_id\'=>$data->id, \'job_id\'=>'.$model->id.', \'wo_id\'=>'.$wo_id.'))',
                ),
                array(
                    'name'=> "Dimensions",
                    'value' => '$data->length." x ".$data->breadth." x ".$data->height." ".$data->dimension_unit',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'chargeable_weight',
                    'value' => 	'$data->chargeable_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'quantity',
                    'value' => 	'$data->quantity." ".$data->subtype." ".$data->type'
                ),  
//                array(
//                        'name'=>'Vehicle',
//                        'type'=>'raw',
//                        'filter'=>'',
//                        'value'=>'CHtml::link(CHtml::encode("Existing"), array(\'trip/create\', \'packageID\'=>$data->id ))."/".CHtml::link(CHtml::encode("New"), array(\'trip/create\', \'packageID\'=>$data->id ))',
//                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
//                ),            
            
            
        ),
        'summaryText' => '', 
)); } 
?>    

<h3> Select packages to add to work order</h3>
    
<?php if ($model->mode == 'SEA FCL') {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$contrsDataProvider,
	'columns'=>array(
                array(
                    'name' => 'check',
                    'id' => 'selectedContrs',
                    'value' => '$data->id',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '100',
                ),
                array(
                        'name'=>'name',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'$data->name',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                array(
                    'name'=> "Contr Type",
                    'value' => '$data->subtype',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                'cargo',
        ),
        'summaryText' => '', 
)); } else {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$contrsDataProvider,
	'columns'=>array(
                array(
                    'name' => 'check',
                    'id' => 'selectedPackages',
                    'value' => '$data->id',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '100',
                ),
                array(
                        'name'=>'cargo',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'$data->cargo',
                ),
                array(
                    'name'=> "Dimensions",
                    'value' => '$data->length." x ".$data->breadth." x ".$data->height." ".$data->dimension_unit',	
                ),		            
                array(
                  'name'=> 'gross_weight',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'net_weight',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'chargeable_weight',
                    'value' => 	'$data->chargeable_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'quantity',
                    'value' => 	'$data->quantity." ".$data->subtype." ".$data->type'
                ),  
//                array(
//                        'name'=>'Vehicle',
//                        'type'=>'raw',
//                        'filter'=>'',
//                        'value'=>'CHtml::link(CHtml::encode("Existing"), array(\'trip/create\', \'packageID\'=>$data->id ))."/".CHtml::link(CHtml::encode("New"), array(\'trip/create\', \'packageID\'=>$data->id ))',
//                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
//                ),            
            
            
        ),
        'summaryText' => '', 
)); } 
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Add/Remove Pkgs'); ?>
                <?php echo CHtml::button('Back', array('submit'=>array('job/view','id'=>$model->id))); ?>
        </div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->