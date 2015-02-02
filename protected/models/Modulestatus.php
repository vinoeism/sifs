<?php

/**
 * This is the model class for table "modulestatus".
 *
 * The followings are the available columns in table 'modulestatus':
 * @property integer $id
 * @property integer $job_id
 * @property integer $voucher_id
 * @property integer $bill_id
 * @property integer $payment_id
 * @property integer $receipt_id
 * @property integer $invoice_id
 * @property string $status
 * @property integer $comments
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Modulestatus extends sifsActiveRecord
{
    
         /** constant definitions
         * 
         */
         const JOB_DOCS = 'Waiting for Client\'s documents';
         const JOB_AO = 'Waiting for AO';
         const JOB_CUSTOMS = 'Waiting for Clearance';
         const VOUCHER_APPROVAL = 'Waiting for Approval';
         const VOUCHER_AUTHORIZE = 'Waiting for Authorization';
         const VOUCHER_FUNDS = 'Waiting for funds';

         
         
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Modulestatus the static model class
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
		return 'modulestatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'required'),
			array('job_id, voucher_id, bill_id, payment_id, receipt_id, invoice_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('created_on, updated_on', 'safe'),
                        array('status', 'length', 'max'=>50),                    
			array('comments', 'length', 'max'=>600),                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_id, voucher_id, bill_id, payment_id, receipt_id, invoice_id,  status, comments, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'jobs' => array(self::BELONGS_TO, 'Job','job_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_id' => 'Job',
			'voucher_id' => 'Voucher',
			'bill_id' => 'Bill',
			'payment_id' => 'Payment',
			'receipt_id' => 'Receipt',
                        'invoice_id' => 'Invoice',
			'status' => 'Status',
			'comments' => 'Comments',
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
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
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('invoice_id',$this->invoice_id);                
		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('receipt_id',$this->receipt_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('comments',$this->comments);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        

        /** 
         * Retrieves the various status messages
         * @return array an array of possible status nessages
         */
        public function getStatusOptions($moduleName)
        {
            if ($moduleName == 'JOB'){
                return array(
                    self::JOB_DOCS=>'Waiting for docs',
                    self::JOB_AO=>'Waiting on the AO',
                    self::JOB_CUSTOMS=>'Waiting for Customs Clearance',

                );
            }
            if ($moduleName == 'VOUCHER'){
                return array(
                    self::VOUCHER_APPROVAL=>'Waiting for approval',
                    self::VOUCHER_FUNDS => 'Waiting for funds',
                );
            }
        }                
}