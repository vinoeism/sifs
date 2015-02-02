<?php

/**
 * This is the model class for table "miracle".
 *
 * The followings are the available columns in table 'miracle':
 * @property integer $id
 * @property string $miracle_date
 * @property string $miracle_type
 * @property string $recepient
 * @property string $prayer_request
 * @property string $start_date
 * @property string $end_date
 * @property string $warriors
 * @property string $testimony
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Miracle extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Miracle the static model class
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
		return 'miracle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('miracle_type', 'length', 'max'=>30),
			array('recepient, warriors', 'length', 'max'=>100),
			array('prayer_request, testimony', 'length', 'max'=>1000),
			array('miracle_date, start_date, end_date, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, miracle_date, miracle_type, recepient, prayer_request, start_date, end_date, warriors, testimony, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
			'miracle_date' => 'Miracle Date',
			'miracle_type' => 'Miracle Type',
			'recepient' => 'Recepient',
			'prayer_request' => 'Prayer Request',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'warriors' => 'Warriors',
			'testimony' => 'Testimony',
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
		$criteria->compare('miracle_date',$this->miracle_date,true);
		$criteria->compare('miracle_type',$this->miracle_type,true);
		$criteria->compare('recepient',$this->recepient,true);
		$criteria->compare('prayer_request',$this->prayer_request,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('warriors',$this->warriors,true);
		$criteria->compare('testimony',$this->testimony,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getMiracleTypes()
        {
            return CHtml::listData(Settings::model()->findAll('setting_key =?', array('miracletype')),'setting_value','setting_value');
        }
}