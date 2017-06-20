<?php

/**
 * This is the model class for table "workorder".
 *
 * The followings are the available columns in table 'workorder':
 * @property integer $id
 * @property string $wo_date
 * @property integer $job_id
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
class Workorder extends sifsActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workorder the static model class
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
		return 'workorder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_id, trip_id, transporter_id, from_location_id, to_location_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('trip_type, vehicle_type, vehicle_instructions', 'length', 'max'=>200),
                        array('transporter_id, wo_date, trip_date_start, from_location, to_location','required'),
			array('from_location, to_location', 'length', 'max'=>500),
			array('wo_date, trip_date_start, trip_date_end, in_time, out_time, created_on, updated_on', 'safe'),
                        array('trip_date_start, trip_date_end', 'isValidTripDate'),
                        array('trip_date_end', 'isValidTripEndDate'),
//                        array('trip_date_start', 'compare', 'wo_date' => date("Y-m-d"), 'operator' => '>='),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, wo_date, job_id, trip_id, transporter_id, trip_type, vehicle_type, trip_date_start, trip_date_end, in_time, out_time, from_location, from_location_id, to_location, to_location_id, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
		);
	}

        public function isValidTripDate($attribute, $params)
        {
            if ($this->$attribute < $this->wo_date) {
                $this->addError($attribute, $attribute . ' cannot be earlier than the WO date');
            }
            
        }
        
        public function isValidTripEndDate($attribute, $params)
        {
            if ($this->$attribute < $this->trip_date_start) {
                $this->addError($attribute, $attribute . ' cannot be earlier than the Trip Start date');
            }
            
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'jobs' => array(self::BELONGS_TO, 'Job', 'job_id'),
                    'transporters' => array(self::BELONGS_TO, 'Party', 'transporter_id'),
                    //'packages'=>array(self::MANY_MANY,'Package','workorderpackage(workorder_id,package_id)'),   
                    'workorderpackages'=>array(self::HAS_MANY,'Workorderpackage','workorder_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wo_date' => 'Wo Date',
			'job_id' => 'Job',
			'trip_id' => 'Trip',
			'transporter_id' => 'Transporter',
                        'vehicle_type' => 'Vehicle Type',
                        'vehicle_instructions' => 'Special Instructions',
			'trip_type' => 'Trip Type',
			'trip_date_start' => 'Reporting date',
			'trip_date_end' => 'Relieving date',
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
		$criteria->compare('wo_date',$this->wo_date,true);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('trip_id',$this->trip_id);
		$criteria->compare('transporter_id',$this->transporter_id);
		$criteria->compare('trip_type',$this->trip_type,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('vehicle_instructions',$this->vehicle_instructions,true);
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
         * Retrieves the Parties for populating the CFS/Transporter fields
         * @return array an array of all parties
         */
        public function getTransporterOptions()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'is_blacklisted = 0 AND party_type ="'.Party::TYPE_TRANSPORTER.'"';
            $partiesArray = CHtml::listData(Party::model()->findAll($criteria),'id','party_name');
            return $partiesArray;
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