<?php

/**
 * This is the model class for table "workorderpackage".
 *
 * The followings are the available columns in table 'workorderpackage':
 * @property integer $id
 * @property integer $workorder_id
 * @property integer $package_id
 * @property integer $trip_id
 * @property integer $transporter_id
 * @property string $vehicle_type
 * @property string $vehicle_instructions
 * @property string $trip_type
 * @property string $trip_date_start
 * @property string $trip_date_end
 * @property string $in_time
 * @property string $out_time
 * @property string $from_location
 * @property integer $from_location_id
 * @property string $to_location
 * @property integer $to_location_id
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Workorderpackage extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workorderpackage the static model class
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
		return 'workorderpackage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workorder_id, package_id, trip_id, transporter_id, from_location_id, to_location_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('vehicle_type, vehicle_instructions, trip_type', 'length', 'max'=>200),
			array('from_location, to_location', 'length', 'max'=>500),
			array('trip_date_start, trip_date_end, in_time, out_time, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, workorder_id, package_id, trip_id, transporter_id, vehicle_type, vehicle_instructions, trip_type, trip_date_start, trip_date_end, in_time, out_time, from_location, from_location_id, to_location, to_location_id, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
			'workorder_id' => 'Workorder',
			'package_id' => 'Package',
			'trip_id' => 'Trip',
			'transporter_id' => 'Transporter',
			'vehicle_type' => 'Vehicle Type',
			'vehicle_instructions' => 'Vehicle Instructions',
			'trip_type' => 'Trip Type',
			'trip_date_start' => 'Trip Date Start',
			'trip_date_end' => 'Trip Date End',
			'in_time' => 'In Time',
			'out_time' => 'Out Time',
			'from_location' => 'From Location',
			'from_location_id' => 'From Location',
			'to_location' => 'To Location',
			'to_location_id' => 'To Location',
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
		$criteria->compare('workorder_id',$this->workorder_id);
		$criteria->compare('package_id',$this->package_id);
		$criteria->compare('trip_id',$this->trip_id);
		$criteria->compare('transporter_id',$this->transporter_id);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('vehicle_instructions',$this->vehicle_instructions,true);
		$criteria->compare('trip_type',$this->trip_type,true);
		$criteria->compare('trip_date_start',$this->trip_date_start,true);
		$criteria->compare('trip_date_end',$this->trip_date_end,true);
		$criteria->compare('in_time',$this->in_time,true);
		$criteria->compare('out_time',$this->out_time,true);
		$criteria->compare('from_location',$this->from_location,true);
		$criteria->compare('from_location_id',$this->from_location_id);
		$criteria->compare('to_location',$this->to_location,true);
		$criteria->compare('to_location_id',$this->to_location_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /** 
         * Retrieves the Parties for populating the Trip Type field
         * @return array an array of all trip types
         */
        public function getTripTypes()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'setting_key = "triptype" AND setting_subkey = "vehicle"';
            $tripsArray = CHtml::listData(Settings::model()->findAll($criteria),'id','setting_value');
            return $tripsArray;
        } 
        /** 
         * Retrieves the Vehicle types for populating the Vehicle Type field
         * @return array an array of all vehicle types
         */
        public function getVehicleTypes()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'setting_key = "vehicle" AND setting_subkey = "type"';
            $vehiclesArray = CHtml::listData(Settings::model()->findAll($criteria),'id','setting_value');
            return $vehiclesArray;
        } 
        
}
        