<?php

/**
 * This is the model class for table "moduledescription".
 *
 * The followings are the available columns in table 'moduledescription':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $voucher_id
 * @property string $description
 * @property string $comments
 * @property string $currency
 * @property string $exchange_rate
 * @property string $rate
 * @property string $quantity
 * @property string $amount
 * @property integer $tax_1
 * @property string $tax_1_amount
 * @property integer $tax_2
 * @property string $tax_2_amount
 * @property integer $isActive
 * @property integer $pass_id
 * @property integer $approve_id
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Moduledescription extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Moduledescription the static model class
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
		return 'moduledescription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, currency, exchange_rate, rate, quantity, amount', 'required'),
			array('invoice_id, voucher_id, tax_1, tax_2, isActive, pass_id, approve_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('comments', 'length', 'max'=>150),
			array('currency', 'length', 'max'=>3),
			array('exchange_rate, rate, quantity, amount, tax_1_amount, tax_2_amount', 'length', 'max'=>10),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, invoice_id, voucher_id, description, comments, currency, exchange_rate, rate, quantity, amount, tax_1, tax_1_amount, tax_2, tax_2_amount, isActive, pass_id, approve_id, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'vouchers' => array(self::BELONGS_TO, 'Voucher', 'voucher_id'),
                    'invoices' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_id' => 'Invoice',
			'voucher_id' => 'Voucher',
			'description' => 'Description',
			'comments' => 'Comments',
			'currency' => 'Currency',
			'exchange_rate' => 'Exchange Rate',
			'rate' => 'Rate',
			'quantity' => 'Quantity',
			'amount' => 'Amount',
			'tax_1' => 'Tax 1',
			'tax_1_amount' => 'Tax 1 Amount',
			'tax_2' => 'Tax 2',
			'tax_2_amount' => 'Tax 2 Amount',
			'isActive' => 'Is Active',
			'pass_id' => 'Pass',
			'approve_id' => 'Approve',
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
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);
		$criteria->compare('rate',$this->rate,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('tax_1',$this->tax_1);
		$criteria->compare('tax_1_amount',$this->tax_1_amount,true);
		$criteria->compare('tax_2',$this->tax_2);
		$criteria->compare('tax_2_amount',$this->tax_2_amount,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('pass_id',$this->pass_id);
		$criteria->compare('approve_id',$this->approve_id);
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
    
    public function getTaxes($moduledescription)
    {
        if (!empty($moduledescription->voucher_id))
            $module = $moduledescription->vouchers;
        if (!empty($moduledescription->invoice_id))
            $module = $moduledescription->invoices;
        return array(CHtml::listData($module->branches->taxes,'id','tax_name'));
    }  
}