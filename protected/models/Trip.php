<?php

/**
 * This is the model class for table "trip".
 *
 * The followings are the available columns in table 'trip':
 * @property integer $id
 * @property string $vehicle_regn_no
 * @property string $vehicle_type
 * @property integer $vehicle_id
 * @property integer $employee_id
 * @property string $trip_type
 * @property string $trip_date_start
 * @property string $trip_date_end
 * @property string $driver_name
 * @property string $driver_phone
 * @property string $in_time
 * @property string $out_time
 * @property integer $start_odo
 * @property integer $end_odo
 * @property string $from_location
 * @property integer $from_location_id
 * @property string $to_location
 * @property integer $to_location_id
 * @property integer $job_id
 * @property integer $transporter_id
 * @property integer $package_id
 * @property integer $booked_by
 * @property string $booked_on
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Trip extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Trip the static model class
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
		return 'trip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, employee_id, start_odo, end_odo, from_location_id, to_location_id, job_id, transporter_id, package_id, booked_by, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('vehicle_regn_no, vehicle_type', 'length', 'max'=>20),
			array('trip_type, from_location, to_location', 'length', 'max'=>200),
			array('driver_name, driver_phone', 'length', 'max'=>50),
			array('trip_date_start, trip_date_end, in_time, out_time, booked_on, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_regn_no, vehicle_type, vehicle_id, employee_id, trip_type, trip_date_start, trip_date_end, driver_name, driver_phone, in_time, out_time, start_odo, end_odo, from_location, from_location_id, to_location, to_location_id, job_id, transporter_id, package_id, booked_by, booked_on, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
			'vehicle_regn_no' => 'Vehicle Regn No',
			'vehicle_type' => 'Vehicle Type',
			'vehicle_id' => 'Vehicle',
			'employee_id' => 'Employee',
			'trip_type' => 'Trip Type',
			'trip_date_start' => 'Trip Date Start',
			'trip_date_end' => 'Trip Date End',
			'driver_name' => 'Driver Name',
			'driver_phone' => 'Driver Phone',
			'in_time' => 'In Time',
			'out_time' => 'Out Time',
			'start_odo' => 'Start Odo',
			'end_odo' => 'End Odo',
			'from_location' => 'From Location',
			'from_location_id' => 'From Location',
			'to_location' => 'To Location',
			'to_location_id' => 'To Location',
			'job_id' => 'Job',
			'transporter_id' => 'Transporter',
			'package_id' => 'Package',
			'booked_by' => 'Booked By',
			'booked_on' => 'Booked On',
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
		$criteria->compare('vehicle_regn_no',$this->vehicle_regn_no,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('vehicle_id',$this->vehicle_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('trip_type',$this->trip_type,true);
		$criteria->compare('trip_date_start',$this->trip_date_start,true);
		$criteria->compare('trip_date_end',$this->trip_date_end,true);
		$criteria->compare('driver_name',$this->driver_name,true);
		$criteria->compare('driver_phone',$this->driver_phone,true);
		$criteria->compare('in_time',$this->in_time,true);
		$criteria->compare('out_time',$this->out_time,true);
		$criteria->compare('start_odo',$this->start_odo);
		$criteria->compare('end_odo',$this->end_odo);
		$criteria->compare('from_location',$this->from_location,true);
		$criteria->compare('from_location_id',$this->from_location_id);
		$criteria->compare('to_location',$this->to_location,true);
		$criteria->compare('to_location_id',$this->to_location_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('transporter_id',$this->transporter_id);
		$criteria->compare('package_id',$this->package_id);
		$criteria->compare('booked_by',$this->booked_by);
		$criteria->compare('booked_on',$this->booked_on,true);
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
        /** 
         * Retrieves the Driver names for populating the Driver Name field
         * @return array an array of all Drivers
         */
        public function getDrivers()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'designation = "driver"';
            $driversArray = CHtml::listData(Employee::model()->findAll($criteria),'id','employee_name');
            return $driversArray;
        }      
        /** 
         * Retrieves the Vehicles  for populating the Vehicle ID field
         * @return array an array of all vehicle types
         */
        public function getVehicles()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'status = "active"';
            $vehiclesArray = CHtml::listData(Vehicle::model()->findAll($criteria),'id','regn_no');
            return $vehiclesArray;
        }         
        /** 
         * Retrieves the users for populating the BookedBy field
         * @return array an array of all users
         */
        public function getUserOptions()
        {
            $criteria = new CDbCriteria();
            $usersArray = CHtml::listData(User::model()->findAll($criteria),'id','username');
            return $usersArray;
        }        
}