<?php

/**
 * This is the model class for table "receipt".
 *
 * The followings are the available columns in table 'receipt':
 * @property integer $id
 * @property string $receipt_date
 * @property integer $branch_id
 * @property integer $party_id
 * @property string $mode
 * @property string $instrument_no
 * @property string $instrument_date
 * @property string $instrument_bank
 * @property string $currency
 * @property string $exchange_rate
 * @property string $TDS
 * @property string $discount
 * @property string $amount
 * @property string $total_amount
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Receipt extends sifsActiveRecord
{
         const MODE_CASH = 'CASH'; 
         const MODE_CHEQUE = 'CHEQUE';   
         const MODE_TRANSFER = 'TRANSFER'; 

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Receipt the static model class
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
		return 'receipt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receipt_date, branch_id, party_id, mode, currency, amount, total_amount', 'required'),
			array('branch_id, party_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('mode', 'length', 'max'=>25),
			array('instrument_no, instrument_bank', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>3),
			array('exchange_rate, TDS, discount, amount, total_amount', 'length', 'max'=>10),
			array('instrument_date, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, receipt_date, branch_id, party_id, mode, instrument_no, instrument_date, instrument_bank, currency, exchange_rate, TDS, discount, amount, total_amount, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'parties'=>array(self::BELONGS_TO,'Party','party_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'receipt_date' => 'Receipt Date',
			'branch_id' => 'Branch',
			'party_id' => 'Party',
			'mode' => 'Mode',
			'instrument_no' => 'Instrument No',
			'instrument_date' => 'Instrument Date',
			'instrument_bank' => 'Instrument Bank',
			'currency' => 'Currency',
			'exchange_rate' => 'Exchange Rate',
			'TDS' => 'TDS',
			'discount' => 'Discount',
			'amount' => 'Amount',
			'total_amount' => 'Total Amount',
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
		$criteria->compare('receipt_date',$this->receipt_date,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('party_id',$this->party_id);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('instrument_no',$this->instrument_no,true);
		$criteria->compare('instrument_date',$this->instrument_date,true);
		$criteria->compare('instrument_bank',$this->instrument_bank,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);
		$criteria->compare('TDS',$this->TDS,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('total_amount',$this->total_amount,true);
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
    
        /** 
         * Retrieves the various Party options 
         * @return array an array of parties
         */
        public function getParties()
        {
            $criteria = new CDbCriteria;
//            $criteria->condition = 'party_type like \'VENDOR\'';
            $criteria->select = array('id', 'party_name');
            return CHtml::listData(Party::model()->findAll($criteria),'id','party_name');
        }     
        
        /** 
         * Retrieves the various modes of receipts
         * @return array an array of modes
         */
        public function getModeOptions()
        {
            return array(
                self::MODE_CASH=>'CASH',
                self::MODE_CHEQUE=>'CHEQUE',
                self::MODE_TRANSFER=>'TRANSFER',
            );
        }    
}