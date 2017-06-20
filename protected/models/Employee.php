<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $employee_id
 * @property string $employee_name
 * @property string $gender
 * @property string $age
 * @property string $phone_number
 * @property string $email_id
 * @property string $designation
 * @property string $status 
 * @property integer $branch_id
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Employee extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employee the static model class
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
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('employee_id, gender', 'length', 'max'=>10),
			array('employee_name', 'length', 'max'=>50),
			array('age', 'length', 'max'=>5),
			array('phone_number', 'length', 'max'=>20),
			array('email_id', 'length', 'max'=>100),
			array('designation, status', 'length', 'max'=>30),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, employee_id, employee_name, gender, age, phone_number, email_id, designation, status, branch_id, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'employee_name' => 'Employee Name',
			'gender' => 'Gender',
			'age' => 'Age',
			'phone_number' => 'Phone Number',
			'email_id' => 'Email',
			'designation' => 'Designation',
                        'status' => 'Status',
			'branch_id' => 'Branch',
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
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('employee_name',$this->employee_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('age',$this->age,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}