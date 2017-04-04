<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $id
 * @property string $REFNO
 * @property integer $branch_id
 * @property integer $job_id
 * @property string $invoice_date
 * @property integer $party_id
 * @property integer $invoice_terms
 * @property string $total_tax_1
 * @property string $total_tax_2
 * @property string $total_amount
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $approved_by
 * @property string $approved_on
 * @property string $approval_comments
 * @property string $due_on
 * @property integer $status
 * @property string $status_date
 * @property integer $is_active
 */
class Invoice extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REFNO, branch_id, job_id, invoice_date, party_id, is_active', 'required'),
			array('branch_id, job_id, party_id, created_by, updated_by, approved_by, status, is_active', 'numerical', 'integerOnly'=>true),
			array('REFNO', 'length', 'max'=>50),
                        array('REFNO', 'unique'),
			array('invoice_terms', 'length', 'max'=>1000),
			array('total_tax_1, total_tax_2, total_amount', 'length', 'max'=>10),
			array('approval_comments', 'length', 'max'=>300),
			array('created_on, updated_on, approved_on, due_on, status_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, REFNO, branch_id, job_id, invoice_date, party_id, invoice_terms, total_tax_1, total_tax_2, total_amount, created_by, created_on, updated_by, updated_on, approved_by, approved_on, approval_comments, due_on, status, status_date, is_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'branches'=>array(self::BELONGS_TO,'Branch','branch_id'),
                    'jobs'=>array(self::BELONGS_TO,'Job','job_id'),
                    'parties'=>array(self::BELONGS_TO,'Party','party_id'),
                    'approvers' => array(self::BELONGS_TO, 'User', 'approved_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'REFNO' => 'REF no',
			'branch_id' => 'Branch',
			'job_id' => 'Job',
			'invoice_date' => 'Invoice Date',
			'party_id' => 'Party',
			'invoice_terms' => 'Invoice Terms',
			'total_tax_1' => 'Total Tax 1',
			'total_tax_2' => 'Total Tax 2',
			'total_amount' => 'Total Amount',
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
			'approved_by' => 'Approved By',
			'approved_on' => 'Approved On',
			'approval_comments' => 'Approval Comments',
			'due_on' => 'Due On',
			'status' => 'Status',
			'status_date' => 'Status Date',
			'is_active' => 'Is Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('REFNO',$this->REFNO,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('party_id',$this->party_id);
		$criteria->compare('invoice_terms',$this->invoice_terms,true);
		$criteria->compare('total_tax_1',$this->total_tax_1,true);
		$criteria->compare('total_tax_2',$this->total_tax_2,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('approved_by',$this->approved_by);
		$criteria->compare('approved_on',$this->approved_on,true);
		$criteria->compare('approval_comments',$this->approval_comments,true);
		$criteria->compare('due_on',$this->due_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_date',$this->status_date,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
	/**
	 * Retrieves a list of parties who can possibly be the Invoice party
	 * @return array an array of Parties.
	 */        
        public function getPartyOptions($job_id)
        {
            $job = Job::model()->findByPk($job_id);
            if (isset($job->client_id)) 
                $parties[$job->client_id] = $job->clients->party_name;
            if (isset($job->shipper))             
                $parties[$job->shipper] = $job->shippers->party_name;
            if (isset($job->consignee)) 
                $parties[$job->consignee] = $job->consignees->party_name;
            if (isset($job->agent)) 
                $parties[$job->agent] = $job->agents->party_name;
            if (isset($job->cfs_id)) 
                $parties[$job->cfs_id] = $job->cfses->party_name;
            if (isset($job->transporter)) 
                $parties[$job->transporter] = $job->transporters->party_name;
            return $parties;
        }

                /** 
         * Retrieves the various terms of payment types
         * @return array an array of possible Terms 
         */
        public function getTermsOfPaymentTypes()
        {
            $criteria = new CDbCriteria();            
            $criteria->condition = 'setting_key = "termsofinvoice"';
            $termsOfInvoiceArray = CHtml::listData(Settings::model()->findAll($criteria),'id','setting_value');

            return $termsOfInvoiceArray;
        }    
        
        
        
}