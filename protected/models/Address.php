<?php

/**
 * This is the model class for table "address".
 *
 * The followings are the available columns in table 'address':
 * @property integer $id
 * @property integer $party_id
 * @property integer $bank_id
 * @property integer $employee_id
 * @property integer $branch_id
 * @property string $type
 * @property string $line_1
 * @property string $line_2
 * @property string $district
 * @property string $state
 * @property string $country
 * @property string $pincode
 * @property string $landline_number
 * @property string $fax_number
 * @property string $website
 * @property string $contact_1
 * @property string $contact_1_designation
 * @property string $contact_1_phone
 * @property string $contact_1_email
 * @property string $contact_2
 * @property string $contact_2_designation
 * @property string $contact_2_phone
 * @property string $contact_2_email
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Address extends sifsActiveRecord
{
        const TYPE_BILLING = 'BILLING';
        const TYPE_SHIPPING = 'SHIPPING';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Address the static model class
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
		return 'address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, country, pincode', 'required'),
			array('party_id, bank_id, employee_id, branch_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('type, pincode', 'length', 'max'=>10),
			array('line_1, line_2, website, contact_1, contact_1_designation, contact_1_phone, contact_1_email, contact_2, contact_2_designation, contact_2_phone, contact_2_email', 'length', 'max'=>100),
			array('district, state, country', 'length', 'max'=>50),
			array('landline_number, fax_number', 'length', 'max'=>12),
                        array('contact_1_email, contact_2_email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, party_id, bank_id, employee_id, branch_id, type, line_1, line_2, district, state, country, pincode, landline_number, fax_number, website, contact_1, contact_1_designation, contact_1_phone, contact_1_email, contact_2, contact_2_designation, contact_2_phone, contact_2_email, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'parties' => array(self::BELONGS_TO, 'Party', 'party_id'),
                    'branches' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'party_id' => 'Party',
			'bank_id' => 'Bank',
			'employee_id' => 'Employee',
			'branch_id' => 'Branch',
			'type' => 'Type',
			'line_1' => 'Line 1',
			'line_2' => 'Line 2',
			'district' => 'District',
			'state' => 'State',
			'country' => 'Country',
			'pincode' => 'Pincode',
			'landline_number' => 'Landline Number',
			'fax_number' => 'Fax Number',
			'website' => 'Website',
			'contact_1' => 'Contact Person',
			'contact_1_designation' => 'Designation',
			'contact_1_phone' => 'Phone',
			'contact_1_email' => 'Email',
			'contact_2' => 'Alternate Contact',
			'contact_2_designation' => 'Designation',
			'contact_2_phone' => 'Phone',
			'contact_2_email' => 'Email',
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
		$criteria->compare('party_id',$this->party_id);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('line_1',$this->line_1,true);
		$criteria->compare('line_2',$this->line_2,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('pincode',$this->pincode,true);
		$criteria->compare('landline_number',$this->landline_number,true);
		$criteria->compare('fax_number',$this->fax_number,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('contact_1',$this->contact_1,true);
		$criteria->compare('contact_1_designation',$this->contact_1_designation,true);
		$criteria->compare('contact_1_phone',$this->contact_1_phone,true);
		$criteria->compare('contact_1_email',$this->contact_1_email,true);
		$criteria->compare('contact_2',$this->contact_2,true);
		$criteria->compare('contact_2_designation',$this->contact_2_designation,true);
		$criteria->compare('contact_2_phone',$this->contact_2_phone,true);
		$criteria->compare('contact_2_email',$this->contact_2_email,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        /** 
         * Retrieves the various address types
         * @return array an array of possible address types
         */
        public function getAddressTypes()
        {
            return array(
                self::TYPE_BILLING=>'Billing',
                self::TYPE_SHIPPING=>'Shipping',
            );
        }  
        
        /** 
         * Retrieves the various addresses for a branch
         * @return array an array of addresses for the branch
         */
        public function getAddressForModule($moduleId, $moduleName)
        {

                $criteria=new CDbCriteria;
		$criteria->select='*';
                if ($moduleName == 'BRANCH') 
                    $criteria->compare('branch_id',$moduleId);
                if ($moduleName == 'PARTY')
                    $criteria->compare('party_id',$moduleId);

                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                ));
                

        }         
}