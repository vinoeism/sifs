<?php

/**
 * This is the model class for table "vehicle".
 *
 * The followings are the available columns in table 'vehicle':
 * @property integer $id
 * @property string $regn_no
 * @property integer $branch_id
 * @property integer $manufacturer_id
 * @property string $model
 * @property string $vehicle_type
 * @property string $rc_no
 * @property string $status
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property string $comments
 */
class Vehicle extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vehicle the static model class
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
		return 'vehicle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, manufacturer_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('regn_no', 'length', 'max'=>20),
			array('model, vehicle_type, rc_no, status', 'length', 'max'=>50),
			array('comments', 'length', 'max'=>500),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, regn_no, branch_id, manufacturer_id, model, vehicle_type, rc_no, status, created_by, created_on, updated_by, updated_on, comments', 'safe', 'on'=>'search'),
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
			'regn_no' => 'Regn No',
			'branch_id' => 'Branch',
			'manufacturer_id' => 'Manufacturer',
			'model' => 'Model',
			'vehicle_type' => 'Vehicle Type',
			'rc_no' => 'Rc No',
                        'status' => 'Status',                    
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
			'comments' => 'Comments',
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
		$criteria->compare('regn_no',$this->regn_no,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('rc_no',$this->rc_no,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}