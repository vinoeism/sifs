<?php

/**
 * This is the model class for table "party".
 *
 * The followings are the available columns in table 'party':
 * @property integer $id
 * @property string $party_name
 * @property string $party_type Description
 * @property string $short_code
 * @property integer $is_blacklisted
 * @property string $pan_no
 * @property string $service_tax_no
 * @property integer $credit_days
 * @property integer $debit_days
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Party extends sifsActiveRecord
{
    
         const TYPE_CUSTOMER = 'CUSTOMER';
         const TYPE_VENDOR = 'VENDOR';
         const TYPE_AGENT = 'AGENT';
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Party the static model class
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
		return 'party';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('party_name, party_type, short_code, is_blacklisted', 'required'),
			array('credit_days, debit_days, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('party_name', 'length', 'max'=>150),
                        array('short_code','unique'),
                        array('is_blacklisted','boolean'),
			array('short_code', 'length', 'max'=>5),
			array('pan_no', 'length', 'max'=>25),
			array('service_tax_no', 'length', 'max'=>35),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, party_name, short_code, is_blacklisted, pan_no, service_tax_no, credit_days, debit_days, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'addresses' => array(self::HAS_MANY, 'Address', 'party_id'),
                    'jobs' => array(self::HAS_MANY, 'Job', 'client_id'),                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'party_name' => 'Party Name',
                        'party_type' => 'Type of Party',
			'short_code' => 'Short Code',
			'is_blacklisted' => 'Is Blacklisted',
			'pan_no' => 'PAN No',
			'service_tax_no' => 'Service Tax No',
			'credit_days' => 'Credit Days',
			'debit_days' => 'Debit Days',
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
		$criteria->compare('party_name',$this->party_name,true);
                $criteria->compare('party_type',$this->party_type,true);
		$criteria->compare('short_code',$this->short_code,true);
		$criteria->compare('is_blacklisted',$this->is_blacklisted);
		$criteria->compare('pan_no',$this->pan_no,true);
		$criteria->compare('service_tax_no',$this->service_tax_no,true);
		$criteria->compare('credit_days',$this->credit_days);
		$criteria->compare('debit_days',$this->debit_days);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /** 
         * Retrieves the various party types
         * @return array an array of possible rty types
         */
        public function getPartyTypes()
        {
            return array(
                self::TYPE_CUSTOMER=>'Customer',
                self::TYPE_VENDOR=>'Vendor',
                self::TYPE_AGENT=>'Agent',
            );
        }        
}