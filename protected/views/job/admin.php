<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#job-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Jobs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
                array(
                        'name'=>'REF NO',
                        'type'=>'raw',
                        'filter'=>true,
                        'value'=>'CHtml::link(CHtml::encode($data->REFNO), array(\'job/view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
		//'Client_REFNO',
		//'init_date',
		//'branch_id',
		//'quote_id',
                array(
                    'name' => 'client_search',
                    'filter'=>CHtml::listData(Party::model()->findAll(array('order'=>'party_name')),'party_name','party_name'),                    
                    'value' => 'isset($data->clients)?$data->clients->party_name:"  -  "',
                ),
            /*
                array(
                    'name' => 'shipp_search',
                    'value' => 'isset($data->shippers)?$data->shippers->party_name:"  -  "',
                ),
                array(
                    'name' => 'conee_search',
                    'value' => 'isset($data->consignees)?$data->consignees->party_name:"  -  "',
                ),    
                
                array(
                    'name' => 'agnt_search',
                    'value' => 'isset($data->agents)?$data->agents->party_name:"  -  "',
                ),
            
                array(
                    'name' => 'transporter_search',
                    'value' => 'isset($data->transporters)?$data->transporters->party_name:"  -  "',
                ),   */         
		//'agent',
		//'cargo',
		//'packages',
		//'assessable_value',
		//'duty_value',
		//'duty_date',
		//'duty_mode',
		array(
                    'name'=>'type',
                    'filter'=>$model->getTypeOptions(),
                ),		
            	array(
                    'name'=>'mode',
                    'filter'=>$model->getModeOptions(),
                ),
		'terms',
		//'gross_weight',
		//'gross_weight_unit',
		//'nett_weight',
		//'nett_weight_unit',
		//'chargeable_weight',
		//'chargeable_weight_unit',
		//'document_references',
		'origin',
		'destination',
		//'transhipment',
		//'carrier_name',
		//'voyage_no',
		//'pickup_date',
		//'stuffing_date',
		//'BE_SB_no',
		//'BE_SB_date',
                'mbl_mawb_no',
                'mbl_mawb_date',
                //'bond_no',
		//'bond_date',
		//'bond_comments',
		//'onboard_date',
		//'transhipment_arrival_date',
		//'transhipment_date',
		//'arrival_date',
		//'cfs_id',
		'contr_nos',
		//'truck_nos',
		//'comments',
		//'enquiry_by',
		//'handled_by',
		//'created_by',
		//'created_on',
		//'updated_by',
		//'updated_on',

	),
)); ?>
