<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property integer $id
 * @property integer $branch_id
 * @property string $payment_date
 * @property integer $party_id
 * @property integer $employee_id
 * @property string $payment_type
 * @property string $mode
 * @property string $instrument_no
 * @property string $instrument_date
 * @property string $instrument_bank
 * @property string $transaction_no
 * @property string $currency
 * @property string $exchange_rate
 * @property string $tds
 * @property string $amount
 * @property string $total_amount
 * @property string $status
 * @property string $remaining_amount
 * @property integer $is_adhoc
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Payment extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, payment_date, party_id, mode, currency, exchange_rate, amount, total_amount', 'required'),
			array('branch_id, party_id, employee_id, is_adhoc, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('payment_type, mode, status', 'length', 'max'=>20),
			array('instrument_no, transaction_no', 'length', 'max'=>30),
			array('instrument_bank', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>5),
			array('exchange_rate, tds, amount, total_amount, remaining_amount', 'length', 'max'=>10),
			array('instrument_date, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, branch_id, payment_date, party_id, employee_id, payment_type, mode, instrument_no, instrument_date, instrument_bank, transaction_no, currency, exchange_rate, tds, amount, total_amount, status, remaining_amount, is_adhoc, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'banks'=>array(self::BELONGS_TO,'Bank','instrument_bank'),
                    'parties'=>array(self::BELONGS_TO,'Party','party_id'),
                    'vouchers' => array(self::MANY_MANY, 'Voucher', 'voucherpayment(voucher_id,payment_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'branch_id' => 'Branch',
			'payment_date' => 'Payment Date',
			'party_id' => 'Party',
			'employee_id' => 'Employee',
			'payment_type' => 'Payment Type',
			'mode' => 'Mode',
			'instrument_no' => 'Instrument No',
			'instrument_date' => 'Instrument Date',
			'instrument_bank' => 'Instrument Bank',
			'transaction_no' => 'Transaction No',
			'currency' => 'Currency',
			'exchange_rate' => 'Exchange Rate',
			'tds' => 'Tds',
			'amount' => 'Amount',
			'total_amount' => 'Total Amount',
			'status' => 'Status',
			'remaining_amount' => 'Remaining Amount',
			'is_adhoc' => 'Is Adhoc',
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
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('party_id',$this->party_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('instrument_no',$this->instrument_no,true);
		$criteria->compare('instrument_date',$this->instrument_date,true);
		$criteria->compare('instrument_bank',$this->instrument_bank,true);
		$criteria->compare('transaction_no',$this->transaction_no,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);
		$criteria->compare('tds',$this->tds,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('total_amount',$this->total_amount,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('remaining_amount',$this->remaining_amount,true);
		$criteria->compare('is_adhoc',$this->is_adhoc);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function getCurrencies()
    {
        return array(CHtml::listData(Settings::model()->findAll('setting_key = ? ', array('currency')),'setting_value','setting_value'));
    }         
        
    public function getBanks($branchId)
    {
        return array(CHtml::listData(Branch::model()->findByPk($branchId)->banks,'id','bank_name'));
    }
}