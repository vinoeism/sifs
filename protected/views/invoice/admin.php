<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Invoice', 'url'=>array('index')),
	//array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'Unpaid Invoices', 'url'=>array('index')),
        array('label'=>'Paid Invoices', 'url'=>array('paidInvoices')),
        array('label'=>'Receipts', 'url'=>array('receipt/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Invoices</h1>

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

<?php 
$invoiceGridWidget = $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                        'name'=>'id',
                        'type'=>'raw',
                        'filter'=>'',
                        'value'=>'CHtml::link(CHtml::encode($data->id), array(\'view\', \'id\'=>$data->id))',
                        //'imageUrl'=>Yii::app()->baseUrl.'/images/click_icon.jpg',
                ),
                'REFNO',
		'invoice_date',            
                array(
                    'name'=>'job_id',
                    'filter'=>CHtml::listData(Job::model()->findAll(array('order'=>'REFNO')),'id','REFNO'),
                    'value'=>'isset($data->jobs)?$data->jobs->REFNO:"  -  "',
                ),
                array(
                    'name'=>'party_id',
                    'filter'=>CHtml::listData(Party::model()->findAll(array('order'=>'party_name')),'id','party_name'),
                    'value'=>'isset($data->parties)?$data->parties->party_name:"  -  "',
                ),            
		'total_tax_1',
		//'total_tax_2',
		'total_amount',
  		'status', 
		array(
                    'name'=>'approved_by',
                    'type'=>'raw',
                    'filter'=>CHtml::listData(User::model()->findAll(array('order'=>'username')),'id','username'),
                    'value'=>'isset($data->approvers)?$data->approvers->username:CHtml::link(CHtml::encode("approve"), array(\'approve\', \'id\'=>$data->id))',   
                ),            
                array(
                        'class'=>'CLinkColumn',
                        'label'=>'receive',
                        'urlExpression'=>'Yii::app()->createUrl("invoice/receive",array("id"=>$data->id))',
                ),             
            
		/*
		'invoice_terms',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on',
		'approved_by',
		'approved_on',
		'approval_comments',
		'due_on',
		'status_date',
		'is_active',
		*/

	),
)); 
$this->renderExportGridButton($invoiceGridWidget,'Export as csv',array('class'=>'btn btn-info pull-right'));

?>
