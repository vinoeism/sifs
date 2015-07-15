<?php

/**
 * This is the model class for table "bank".
 *
 * The followings are the available columns in table 'bank':
 * @property integer $id
 * @property integer $party_id
 * @property integer $branch_id
 * @property integer $employee_id
 * @property string $bank_name
 * @property string $bank_address
 * @property string $account_no
 * @property string $ifsc_code
 * @property string $swift_code
 * @property string $comments
 * @property string $status
 * @property integer $isActive
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Bank extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bank the static model class
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
		return 'bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_name, account_no, ifsc_code', 'required'),
			array('party_id, branch_id, employee_id, isActive, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('bank_name', 'length', 'max'=>100),
			array('bank_address, comments', 'length', 'max'=>300),
			array('account_no, ifsc_code, swift_code', 'length', 'max'=>30),
			array('status', 'length', 'max'=>20),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, party_id, branch_id, employee_id, bank_name, bank_address, account_no, ifsc_code, swift_code, comments, status, isActive, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'branches'=> array(self::BELONGS_TO, 'Branch', 'bank_id'),

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
			'branch_id' => 'Branch',
			'employee_id' => 'Employee',
			'bank_name' => 'Bank Name',
			'bank_address' => 'Bank Address',
			'account_no' => 'Account No',
			'ifsc_code' => 'Ifsc Code',
			'swift_code' => 'Swift Code',
			'comments' => 'Comments',
			'status' => 'Status',
			'isActive' => 'Is Active',
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
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_address',$this->bank_address,true);
		$criteria->compare('account_no',$this->account_no,true);
		$criteria->compare('ifsc_code',$this->ifsc_code,true);
		$criteria->compare('swift_code',$this->swift_code,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}