<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property integer $id
 * @property string $branch_name
 * @property string $branch_location
 * @property string $branch_code
 * @property integer $is_registered_office
 * @property string $PAN_no
 * @property string $ST_registration_no
 * @property string $comments
 * @property string $bank_id
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * 
 */
class Branch extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Branch the static model class
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
		return 'branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_name, branch_location, branch_code', 'required'),
			array('is_registered_office, created_by, updated_by', 'numerical', 'integerOnly'=>true),
                        array('branch_code', 'length', 'max'=>5),
                        array('branch_code', 'length', 'min'=>3),
			array('branch_name', 'length', 'max'=>100),
                        array('is_registered_office','boolean'),
			array('branch_location, PAN_no, ST_registration_no', 'length', 'max'=>50),
			array('comments', 'length', 'max'=>300),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, branch_name, branch_location, branch_code, is_registered_office, PAN_no, ST_registration_no, comments, bank_id, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'addresses' => array(self::HAS_ONE, 'Address', 'branch_id'),
                    'jobs' => array(self::HAS_MANY, 'Job', 'branch_id'),
                    'taxes' => array(self::MANY_MANY, 'Tax', 'branchtax(branch_id,tax_id)'),
                    'users' => array(self::MANY_MANY, 'User', 'userbranch(branch_id,user_id)'),
                    'vouchers' => array(self::HAS_MANY, 'Voucher', 'branch_id'),
                    'payments' => array(self::HAS_MANY, 'Payment', 'branch_id'),
                    'banks' => array(self::HAS_MANY, 'Bank', 'branch_id','condition'=>'isActive=1'),
                    'primarybank' => array(self::HAS_ONE, 'Bank', 'branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'branch_name' => 'Branch Name',
			'branch_location' => 'Branch Location',
                        'branch_code' => 'Branch code',
			'is_registered_office' => 'Is Regd Office',
			'PAN_no' => 'PAN No',
			'ST_registration_no' => 'Sales Tax No',
			'comments' => 'Comments',
                        'bank_id' => 'Default Bank',
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
		$criteria->compare('branch_name',$this->branch_name,true);
		$criteria->compare('branch_location',$this->branch_location,true);
		$criteria->compare('branch_code',$this->branch_code,true);                
		$criteria->compare('is_registered_office',$this->is_registered_office);
		$criteria->compare('PAN_no',$this->PAN_no,true);
		$criteria->compare('ST_registration_no',$this->ST_registration_no,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('bank_id',$this->bank_id,true);                                
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}        
}