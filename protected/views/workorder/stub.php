<?php echo CHtml::image(dirname(Yii::app()->getBaseUrl(true)).DIRECTORY_SEPARATOR.'sifs/images'.DIRECTORY_SEPARATOR.'sifs_top.jpg', 'DORE'); ?>
<br><br>

<div style="width:100%; overflow:hidden;">
    <div style="width: 300px; float: left;">
         <h1>Work Order no. <?php echo $model->id; ?></h1>
        <br>
        Issued to:
        <h5>
            <?php foreach ($model->transporters->addresses as $Address) { 
                if ($Address->type == "BILLING") {
                ?>
                    <?php echo $model->transporters->party_name; ?><br/>
                    <?php echo $Address->line_1; ?><br/>
                    <?php echo $Address->line_2; ?><br/>
                    <?php echo $Address->district.', '; ?><br/>
                    <?php echo $Address->state.', '.$Address->country.' '.$Address->pincode; ?>
            <?php } } ?>
        </h5>
        <br>
        We request you to kindly place the vehicle at <b> <?php echo $model->from_location." on ".$model->trip_date_start; ?> </b>
        <br>Delivery at <b> <?php echo $model->to_location; ?> </b>
        <br><br>
        Cargo details as under
        <br><br>
    </div>
    <div style="width: 300px; float: right;">    
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                    array(
                        'name'=>'job_id',
                        'value'=>$model->jobs->REFNO,
                    ),		
                    array(
                        'name'=>'Client REF NO',
                        'value'=>$model->jobs->Client_REFNO,
                    ),	
                    array(
                        'name'=>'BE/SB no',
                        'value'=>$model->jobs->BE_SB_no.' dt. '.$model->jobs->BE_SB_date,
                    ),	
                    array(
                        'name'=>'carrier_name',
                        'value'=>$model->jobs->liner_carrier_name.' '.$model->jobs->voyage_no ,
                    ),	
                    array(
                        'name'=>'origin',
                        'value'=>$model->jobs->origin,
                    ),	
                    array(
                        'name'=>'destination',
                        'value'=>$model->jobs->destination,
                    ),	
                    array(
                        'name'=>'assessable_value',
                        'value'=>$model->jobs->assessable_value,
                    ),	
                    array(
                        'name'=>'cargo',
                        'value'=>$model->jobs->cargo,
                    ),	
                    array(
                        'name'=>'gross_weight',
                        'value'=>$model->jobs->gross_weight.' '.$model->jobs->gross_weight_unit,
                    ),	
                    array(
                        'name'=>'nett_weight',
                        'value'=>$model->jobs->nett_weight.' '.$model->jobs->nett_weight_unit,
                    ),	
                    array(
                        'name'=>'packages',
                        'value'=>$model->jobs->packages,
                    ),	
            ),
        )); ?>

    </div>
</div>

<div>
    <?php if ($model->jobs->mode == 'SEA FCL') {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$packagesDataProvider,
	'columns'=>array(
                array(
                    'name'=>'Contr no',
                    'value'=>'$data->name',
                ),
                array(
                    'name'=> "Contr Type",
                    'value' => '$data->subtype',	
                ),		            
                array(
                  'name'=> 'Gross Wt',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'Nett Wt',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'Cargo Desc',
                    'value' => 	'$data->cargo'
                ),
            ),
        'summaryText' => '', 
)); } else {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$packagesDataProvider,
	'columns'=>array(
                array(
                        'name'=>'Cargo Desc',
                        'value'=>'$data->cargo',
                ),
                array(
                    'name'=> "Dimensions",
                    'value' => '$data->length." x ".$data->breadth." x ".$data->height." ".$data->dimension_unit',	
                ),		            
                array(
                  'name'=> 'Gross Wt',
                    'value' => 	'$data->gross_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'Nett Wt',
                    'value' => 	'$data->net_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'Chargeable Wt',
                    'value' => 	'$data->chargeable_weight." ".$data->weight_unit'
                ),
                array(
                  'name'=> 'Qty',
                    'value' => 	'$data->quantity." ".$data->subtype." ".$data->type'
                ),            
            
        ),
        'summaryText' => '', 
)); } 
?>
    
    
</div>
<br/><br/>

<div style="width:100%; overflow:hidden;">
        <h5>Terms & Conditions </h5>
        <i style="font-size: 9;">
            1. Please let us know if you cannot place the vehicle at the destination on time. <br>
            2. Conditions 2 <br>
            3. Conditions 3 <br>
        </i>
</div>

<p style="text-align: center;"><strong>Electronic document. Does not require a signature to authorize.</strong></p>

<p style="text-align: center;"> 
    <?php echo $model->jobs->branches->addresses->line_1; ?>
    <?php echo $model->jobs->branches->addresses->line_2; ?>
    <?php echo $model->jobs->branches->addresses->district.', '; ?>
    <?php echo $model->jobs->branches->addresses->state.', '.$model->jobs->branches->addresses->country.' '.$model->jobs->branches->addresses->pincode; ?>
    <?php echo '| PAN  '.$model->jobs->branches->PAN_no; ?>
    <?php echo '| SERV TAX REGN  '.$model->jobs->branches->ST_registration_no; ?>
</p>

