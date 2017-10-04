<?php echo CHtml::image(dirname(Yii::app()->basePath).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'sifs_top.jpg', 'DORE'); ?>
<br><br>
<div style="width:100%; overflow:hidden;">
    <div style="width: 300px; float: left;">
         <h1>Trip no. <?php echo $model->id." dtd ".$model->booked_on; ?></h1>
        <br>
        <h3>Vehicle Details</h3>
        <?php if (empty($model->vehicle_id)) { ?>
            <br> <?php echo "RENTAL VEHICLE"; ?> <br>
            <h4> <?php echo Settings::model()->findBySettingKey($model->vehicle_type); ?></h4>
            <h4> <?php echo $model->vehicle_reg_no; ?></h4>
        <?php } else { ?>
            <br> <?php echo "OWN VEHICLE"; ?> <br>
            <h4> <?php echo Vehicle::model()->findbyPk($model->vehicle_id)->regn_no; ?></h4>
        <?php } ?>
        <h5>

        </h5>
        <br>
        We request you to kindly place the vehicle(s) at <b> <?php echo $model->from_location." on ".$model->trip_date_start; ?> </b>
        <br>Delivery at <b> <?php echo $model->to_location; ?> </b>
        <br>
        Special Instructions - <?php echo 'vehicle'; ?><br/>
        <br>
        Cargo details as under
        <br><br>
    </div>
    <div style="width: 300px; float: right;">    
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$jobsDataProvider,
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
//                    array(
//                        'name'=>'cargo',
//                        'value'=>$model->jobs->cargo,
//                    ),	
//                    array(
//                        'name'=>'gross_weight',
//                        'value'=>$model->jobs->gross_weight.' '.$model->jobs->gross_weight_unit,
//                    ),	
//                    array(
//                        'name'=>'nett_weight',
//                        'value'=>$model->jobs->nett_weight.' '.$model->jobs->nett_weight_unit,
//                    ),	
//                    array(
//                        'name'=>'packages',
//                        'value'=>$model->jobs->packages,
//                    ),	
            ),
        )); ?>

    </div>
</div>

<!--<div>
    <?php if ($model->jobs->mode == 'SEA FCL') {
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$wopkgsDataProvider,
	'columns'=>array(
                array(
                    'name'=>'Contr no',
                    'value'=>'Package::model()->findbyPk($data->package_id)->name',
                ),
                array(
                    'name'=> "Contr Type",
                    'value' => 'Package::model()->findbyPk($data->package_id)->subtype',	
                ),		            
                array(
                  'name'=> 'Gross Wt',
                    'value' => 	'Package::model()->findbyPk($data->package_id)->gross_weight." ".Package::model()->findbyPk($data->package_id)->weight_unit'
                ),
                array(
                  'name'=> 'Nett Wt',
                    'value' => 	'Package::model()->findbyPk($data->package_id)->net_weight." ".Package::model()->findbyPk($data->package_id)->weight_unit'
                ),
                array(
                  'name'=> 'Cargo Desc',
                    'value' => 	'Package::model()->findbyPk($data->package_id)->cargo'
                ),
                array(
                  'name'=> 'From / To',
                    'value' => 	'$data->from_location." / ".$data->to_location'
                ),            
                array(
                  'name'=> 'Vehicle Type',
                    'value' => 	'Settings::model()->findbyPk($data->vehicle_type)->setting_value'
                ),
                array(
                  'name'=> 'Special Inst',
                    'value' => 	'$data->vehicle_instructions'
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
    
    
</div>-->


<p style="text-align: center;"><strong>Electronic document. Does not require a signature to authorize.</strong></p>

<p style="text-align: center;"> 
    <?php echo $model->jobs->branches->addresses->line_1; ?>
    <?php echo $model->jobs->branches->addresses->line_2; ?>
    <?php echo $model->jobs->branches->addresses->district.', '; ?>
    <?php echo $model->jobs->branches->addresses->state.', '.$model->jobs->branches->addresses->country.' '.$model->jobs->branches->addresses->pincode; ?>
    <?php echo '| PAN  '.$model->jobs->branches->PAN_no; ?>
    <?php echo '| SERV TAX REGN  '.$model->jobs->branches->ST_registration_no; ?>
</p>

