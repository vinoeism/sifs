<?php echo CHtml::image(dirname(Yii::app()->getBaseUrl(true)).DIRECTORY_SEPARATOR.'sifs/images'.DIRECTORY_SEPARATOR.'sifs_top.jpg', 'DORE'); ?>
<br><br>

<h1>Tax Invoice </h1>

<div style="width:100%; overflow:hidden;">
    <div style="width: 300px; float: left;">
         <h4>Invoice no. <?php echo $model->REFNO; ?> - dtd. <?php echo $model->invoice_date; ?></h4>
        <?php echo 'Terms: '.Settings::model()->findByPk($model->invoice_terms)->setting_value.' | Due on '.$model->due_on ?><br><br><br><br>
        <h5>
            <?php foreach ($model->parties->addresses as $Address) { 
                if ($Address->type == "BILLING") {
                ?>
                    <?php echo $model->parties->party_name; ?><br/>
                    <?php echo $Address->line_1; ?><br/>
                    <?php echo $Address->line_2; ?><br/>
                    <?php echo $Address->district.', '; ?><br/>
                    <?php echo $Address->state.', '.$Address->country.' '.$Address->pincode; ?>
            <?php } } ?>
        </h5>
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
                        'value'=>$model->jobs->carrier_name.' '.$model->jobs->voyage_no ,
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

<br/><br/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'moduledescription-grid',
        'dataProvider'=>$itemsDataProvider,
        'columns'=>array(
                'description'=>array(
                        'name'=>'Description',
                        'value'=>'$data["description"]', 
                        'htmlOptions'=>array('style' => 'text-align: left;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: center;')), 
                'currency'=>array(
                        'name'=>'Currency', 
                        'value'=>'$data["currency"]', 
                        'htmlOptions'=>array('style' => 'text-align: center;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: center;')), 
                'exchange_rate'=>array(
                        'name'=>'Ex Rate', 
                        'value'=>'number_format($data["exchange_rate"], 2,".",",")', 
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: right;')), 
                'rate'=>array(
                        'name'=>'Rate', 
                        'value'=>'number_format($data["rate"], 2,".",",")', 
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: right;')), 
                'quantity'=>array(
                        'name'=>'Qty', 
                        'value'=>'number_format($data["quantity"], 2,".",",")', 
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: right;')), 
                'amount'=>array(
                        'name'=>'Amount', 
                        'value'=>'number_format($data["amount"], 2,".",",")', 
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: right;')), 
                'tax_1_amount'=>array(
                        'name'=>'Tax', 
                        'value'=>'number_format($data["tax_1_amount"], 2,".",",")', 
                        'htmlOptions'=>array('style' => 'text-align: right;'),
                        'headerHtmlOptions'=>array('style' => 'text-align: right;')), 
                //'tax_2',
              //  'tax_2_amount',
            ),
        'summaryText' => '',
)); ?>
<div style="width:100%; overflow:hidden;">
    <div style="width: 350px; float: left;">
        <h5>Errors & Omissions excepted</h5>
        <i style="font-size: 9;">
            1. We reserve the right to charge interest at 24% per annum, for delays after 30 days from the date of invoice <br>
            2. We certify that we have not charged for our service as CHA in excess of the rates approved by commissioner of customs from time to time under Regulation 25 of CHA L.R.84. <br><br>
            Please make the payments in the name of "<?php echo Settings::model()->findBySettingKey('invoiceChequeName'); ?>" through Cheque/DD only <br><br>
            For NEFT/RTGS, please use the below details<br>
            <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(                    
                    array(
                        'name'=>'Bank Name',
                        'value'=>$model->branches->primarybank->bank_name,
                    ),	
                    array(
                        'name'=>'Branch Address',
                        'value'=>$model->branches->primarybank->bank_address,
                    ),	
                    array(
                        'name'=>'Account no',
                        'value'=>$model->branches->primarybank->account_no,
                    ),	
                    array(
                        'name'=>'IFSC Code',
                        'value'=>$model->branches->primarybank->ifsc_code,
                    ),	
                    array(
                        'name'=>'SWIFT Code',
                        'value'=>$model->branches->primarybank->swift_code,
                    ),	
            ),
        )); ?>
        </i>
    </div>
    <div style="width: 250px; float: right;">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(                    
                    array(
                        'name'=>'Sub Total',
                        'value'=>number_format($model->total_amount, 2,".",","),
                        'htmlOptions'=>array('style'=>'text-align: right'),
                        
                    ),	
                    array(
                        'name'=>'Service Tax @ 14%',
                        'value'=>number_format($model->total_tax_1, 2,".",","),
                        'htmlOptions'=>array('style'=>'text-align: right'),
                        
                    ),	
                    array(
                        'name'=>'Total',
                        'value'=>number_format($model->total_amount + $model->total_tax_1, 2,".",","),
                        'htmlOptions'=>array('style'=>'text-align: right'),

                        ),		
            ),
        )); ?>    
    </div>
</div>

<p style="text-align: center;"><strong>Electronic invoice. Does not require a signature to authorize.</strong></p>

<p style="text-align: center;"> 
    <?php echo $model->branches->addresses->line_1; ?>
    <?php echo $model->branches->addresses->line_2; ?>
    <?php echo $model->branches->addresses->district.', '; ?>
    <?php echo $model->branches->addresses->state.', '.$model->branches->addresses->country.' '.$model->branches->addresses->pincode; ?>
    <?php echo '| PAN  '.$model->branches->PAN_no; ?>
    <?php echo '| SERV TAX REGN  '.$model->branches->ST_registration_no; ?>
</p>

