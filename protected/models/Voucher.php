<?php

/**
 * This is the model class for table "voucher".
 *
 * The followings are the available columns in table 'voucher':
 * @property integer $id
 * @property string $voucher_date
 * @property integer $branch_id
 * @property string $voucher_type
 * @property integer $bill_id
 * @property integer $job_id
 * @property integer $employee_id
 * @property integer $vehicle_id
 * @property integer $asset_id
 * @property string $total_tax_1
 * @property string $total_tax_2
 * @property string $total_amount
 * @property string $towards
 * @property string $comments
 * @property integer $pay_to recepient of the voucher
 * @property string $bill_no Bill number
 * @property string $bill_date Date of the bill
 * @property integer $bill_amount Bill amount
 * @property string $due_on due date of the voucher
 * @property integer $tds Tax deducted at source
 * @property integer $discount Discount
 * @property integer $passed_by
 * @property string $passed_on
 * @property string $passed_comments
 * @property integer $approved_by
 * @property string $approved_on
 * @property string $approval_comments
 * @property integer $rejected_by
 * @property string $rejected_on
 * @property string $rejection_comments
 * @property integer $hold_by
 * @property string $hold_on
 * @property string $hold_comments
 * @property string $priority
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Voucher extends sifsActiveRecord
{
        /**
         * constant definitions
         */
    
         const PRIORITY_LOW = 'LOW'; 
         const PRIORITY_MEDIUM = 'MEDIUM';    
         const PRIORITY_HIGH = 'HIGH';    

         const TYPE_CASH = 'CASH'; 
         const TYPE_CHEQUE = 'CHEQUE';   
         const TYPE_TRANSFER = 'TRANSFER'; 
         const TYPE_SUSPENSE = 'SUSPENSE';    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Voucher the static model class
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
		return 'voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voucher_date, branch_id, voucher_type, pay_to', 'required'),
			array('branch_id, bill_id, job_id, employee_id, vehicle_id, asset_id, pay_to, passed_by, approved_by, rejected_by, hold_by, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('voucher_type', 'length', 'max'=>20),
                        array('bill_no','length','max'=>30),
			array('total_tax_1, total_tax_2, bill_amount, total_amount, priority, tds, discount', 'length', 'max'=>13),
			array('towards', 'length', 'max'=>100),
			array('comments, passed_comments, approval_comments, rejection_comments, hold_comments', 'length', 'max'=>300),
			array('due_on, passed_on, approved_on, rejected_on, hold_on, bill_date, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, voucher_date, branch_id, voucher_type, bill_id, job_id, employee_id, vehicle_id, asset_id, total_tax_1, total_tax_2, total_amount, towards, comments, pay_to, bill_no, bill_amount, bill_date, due_on, passed_by, passed_on, passed_comments, approved_by, approved_on, approval_comments, rejected_by, rejected_on, rejection_comments, hold_by, hold_on, hold_comments, priority, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                      'jobs' => array(self::BELONGS_TO, 'Job', 'job_id'),                    
                      'branches' => array(self::BELONGS_TO, 'Branch', 'branch_id'),    
                      'items' => array(self::HAS_MANY,'Moduledescription', 'voucher_id'),
                      'passers' => array(self::BELONGS_TO, 'User', 'passed_by'),
                      'approvers' => array(self::BELONGS_TO, 'User', 'approved_by'),
                      'rejecters' => array(self::BELONGS_TO, 'User', 'rejected_by'),
                      'parties' => array(self::BELONGS_TO, 'Party', 'pay_to'),
                      'payments' => array(self::MANY_MANY, 'Payment', 'voucherpayment(voucher_id, payment_id)'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'voucher_date' => 'Date',
			'branch_id' => 'Branch',
			'voucher_type' => 'Type',
			'bill_id' => 'Bill',
			'job_id' => 'Job',
			'employee_id' => 'Employee',
			'vehicle_id' => 'Vehicle',
			'asset_id' => 'Asset',
			'total_tax_1' => 'Tax 1',
			'total_tax_2' => 'Tax 2',
			'total_amount' => 'Pre-tax Amount',
			'towards' => 'Towards',
			'comments' => 'Comments',
                        'pay_to' => 'Pay to',
                        'bill_no' => 'Bill no',
                        'bill_date' => 'Bill date',
                        'bill_amount' => 'Bill amount',
                        'due_on' => 'Due date',
                        'tds'=> 'TDS',
                        'discount' => 'Discount',
			'passed_by' => 'Passed By',
			'passed_on' => 'Passed On',
			'passed_comments' => 'Passed Comments',
			'approved_by' => 'Approved By',
			'approved_on' => 'Approved On',
			'approval_comments' => 'Approval Comments',
			'rejected_by' => 'Rejected By',
			'rejected_on' => 'Rejected On',
			'rejection_comments' => 'Rejection Comments',
			'hold_by' => 'Hold By',
			'hold_on' => 'Hold On',
			'hold_comments' => 'Hold Comments',
                        'priority' => 'Priority',
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
		$criteria->compare('voucher_date',$this->voucher_date,true);
		$criteria->compare('voucher_type',$this->voucher_type,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('bill_id',$this->bill_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('vehicle_id',$this->vehicle_id);
		$criteria->compare('asset_id',$this->asset_id);
		$criteria->compare('total_tax_1',$this->total_tax_1,true);
		$criteria->compare('total_tax_2',$this->total_tax_2,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('towards',$this->towards,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('pay_to',$this->pay_to,true);
		$criteria->compare('bill_no',$this->bill_no,true);
		$criteria->compare('bill_date',$this->bill_date,true);
		$criteria->compare('bill_amount',$this->bill_amount,true);                
		$criteria->compare('due_on',$this->due_on,true);                
		$criteria->compare('tds',$this->tds,true);                
		$criteria->compare('discount',$this->discount,true);                
                $criteria->compare('passed_by',$this->passed_by);
		$criteria->compare('passed_on',$this->passed_on,true);
		$criteria->compare('passed_comments',$this->passed_comments,true);
		$criteria->compare('approved_by',$this->approved_by);
		$criteria->compare('approved_on',$this->approved_on,true);
		$criteria->compare('approval_comments',$this->approval_comments,true);
		$criteria->compare('rejected_by',$this->rejected_by);
		$criteria->compare('rejected_on',$this->rejected_on,true);
		$criteria->compare('rejection_comments',$this->rejection_comments,true);
		$criteria->compare('hold_by',$this->hold_by);
		$criteria->compare('hold_on',$this->hold_on,true);
		$criteria->compare('hold_comments',$this->hold_comments,true);
                $criteria->compare('priority',$this->priority,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /** 
         * Retrieves the various priorities of voucher
         * @return array an array of possible priorities of voucher
         */
        public function getPriorityOptions()
        {
            return array(
                self::PRIORITY_LOW=>'LOW',
                self::PRIORITY_MEDIUM=>'MEDIUM',
                self::PRIORITY_HIGH=>'HIGH',

            );
        }    
        
        /** 
         * Retrieves the various types of voucher
         * @return array an array of possible types of voucher
         */
        public function getTypeOptions()
        {
            return array(
                self::TYPE_CASH=>'CASH',
                self::TYPE_CHEQUE=>'CHEQUE',
                self::TYPE_TRANSFER=>'TRANSFER',
                self::TYPE_SUSPENSE=>'SUSPENSE',

            );
        }   
                
        /** 
         * Retrieves the various types of expenses for a branch
         * @return array an array of possible expenses of a branch
         */
        public function getBranchExpenses()
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'setting_key like \'branchexpense\'';
            $criteria->select = 'setting_value';
            return CHtml::listData(Settings::model()->findAll($criteria),'setting_value','setting_value');
                    
        } 
        
        /** 
         * Retrieves the various Pay-to options of voucher
         * @return array an array of possible payees of voucher
         */
        public function getPayeeOptions()
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'party_type like \'VENDOR\' or party_type like \'TRANSPORTER\' or party_type like \'CFS\'';
            $criteria->select = array('id', 'party_name');
            return CHtml::listData(Party::model()->findAll($criteria),'id','party_name');
        }        
}