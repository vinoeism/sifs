<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $subtype
 * @property double $length
 * @property double $breadth
 * @property double $height
 * @property string $dimension_unit
 * @property double $gross_weight
 * @property double $net_weight
 * @property double $chargeable_weight
 * @property string $weight_unit
 * @property integer $quantity
 * @property string $cargo
 * @property integer $job_id
 * @property integer $quote_id
 */
class Package extends CActiveRecord
{
        /** constant definitions
         * 
         */    
        // weight units should not cross 5 characters
        const UNIT_MGS = 'mg(s)';    
        const UNIT_GMS = 'gm(s)';    
        const UNIT_KGS = 'Kg(s)';
        const UNIT_MTS = 'MT(s)';
        const UNIT_CBM = 'CBM';
        const UNIT_CNTRS = 'CNTRs';
        // length units
        const UNIT_MM = 'mm(s)';
        const UNIT_CM = 'cm(s)';
        const UNIT_M = 'M(s)';
        const UNIT_FT = 'ft';
        const UNIT_IN = 'in';         
        // type of packages
        const TYPE_CONTR =  'Container(s)';
        const TYPE_CARTON =  'Carton(s)';
        const TYPE_PKG =  'Package(s)';
        const TYPE_PALLET =  'Pallet(s)';
        //contr types
        const SUB_TYPE_20DVCONTR = '20\' Dry Van ';
        const SUB_TYPE_20FTCONTR = '20\' Flat Track ';
        const SUB_TYPE_20OTCONTR = '20\' Open Top ';
        const SUB_TYPE_20RFCONTR = '20\' Reefer ';
        const SUB_TYPE_40DVCONTR = '40\' Dry Van ';
        const SUB_TYPE_40HCCONTR = '40\' High Cube ';
        const SUB_TYPE_40FTCONTR = '40\' Flat Track ';
        const SUB_TYPE_40OTCONTR = '40\' Open Top ';
        const SUB_TYPE_40RFCONTR = '40\' Reefer ';
        //pkg types
        const SUB_TYPE_WOODEN = 'Wooden';
        const SUB_TYPE_CARDBOARD = 'Cardboard';
        
        //public variables
        public $total_gross_weight;
        public $total_net_weight;
        public $total_chargeable_weight;
        public $total_quantity;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Package the static model class
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
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, cargo', 'required'),
                        array('name', 'required', 'message'=>'Please enter a value for {attribute}.'),
			array('id, quantity, job_id, quote_id', 'numerical', 'integerOnly'=>true),
			array('length, breadth, height, gross_weight, net_weight, chargeable_weight', 'numerical'),
			array('name, type, subtype', 'length', 'max'=>50),
                        array('cargo','length','max'=>300),
			array('dimension_unit, weight_unit', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, subtype, length, breadth, height, dimension_unit, gross_weight, net_weight, chargeable_weight, weight_unit, quantity, cargo, job_id, quote_id', 'safe', 'on'=>'search'),
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
                    'jobs'=>array(self::BELONGS_TO,'Job','job_id'),                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Contr no',
			'type' => 'Type',
			'subtype' => 'Subtype',
			'length' => 'Length',
			'breadth' => 'Breadth',
			'height' => 'Height',
			'dimension_unit' => 'Dimension Unit',
			'gross_weight' => 'Gross Weight',
			'net_weight' => 'Nett Weight',
			'chargeable_weight' => 'Chargeable Weight',
			'weight_unit' => 'Weight Unit',
			'quantity' => 'Quantity',
			'cargo' => 'Cargo Description',
			'job_id' => 'Job',
			'quote_id' => 'Quote',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('subtype',$this->subtype,true);
		$criteria->compare('length',$this->length);
		$criteria->compare('breadth',$this->breadth);
		$criteria->compare('height',$this->height);
		$criteria->compare('dimension_unit',$this->dimension_unit,true);
		$criteria->compare('gross_weight',$this->gross_weight);
		$criteria->compare('net_weight',$this->net_weight);
		$criteria->compare('chargeable_weight',$this->chargeable_weight);
		$criteria->compare('weight_unit',$this->weight_unit,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('cargo',$this->cargo);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('quote_id',$this->quote_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /** 
         * Retrieves the various weight units
         * @return array an array of possible weight units 
         */
        public function getWeightUnitsOptions()
        {
            return array(
//                self::UNIT_CBM=>'CBM', // CBM disabled because it will autocomputed
                self::UNIT_MGS=>'milligram(s)',
                self::UNIT_GMS=>'gram(s)',
                self::UNIT_KGS=>'Kilogram(s)',
                self::UNIT_MTS=>'Metric Tonne(s)',
            );
        }        
        
        /** 
         * Retrieves the various units of measurement
         * @return array an array of possible units of measurement
         */
        public function getDimensionUnitsOptions()
        {
            return array(
                self::UNIT_MM=>'mm(s)',
                self::UNIT_CM=>'cm(s)',
                self::UNIT_M=>'metre(s)',
                self::UNIT_FT=>'ft',
                self::UNIT_IN=>'in',
            );
        }      
        
        /** 
         * Retrieves the various types of Packages
         * @return array an array of possible units of measurement
         */
        public function getTypesOptions()
        {
            return array(
//                self::TYPE_CONTR=>'Containers', //contrs are disabled because they are updated from the code directly.
                self::TYPE_CARTON=>'Carton(s)',
                self::TYPE_PKG=>'Package(s)',
                self::TYPE_PALLET=>'Pallet(s)',
            );
        }   
        
        
        /** 
         * Retrieves the various sub types in the contrs
         * @return array an array of possible contr types
         */
        public function getContrOptions()
        {
            return array(
                self::SUB_TYPE_20DVCONTR=>'20\' Dry Van ',
                self::SUB_TYPE_20FTCONTR=>'20\' Flat Track ',
                self::SUB_TYPE_20OTCONTR=>'20\' Open Top ',
                self::SUB_TYPE_20RFCONTR=>'20\' Reefer ',
                self::SUB_TYPE_40DVCONTR=>'40\' Dry Van ',
                self::SUB_TYPE_40HCCONTR=>'40\' High Cube ',
                self::SUB_TYPE_40FTCONTR=>'40\' Flat Track ',
                self::SUB_TYPE_40OTCONTR=>'40\' Open Top ',
                self::SUB_TYPE_40RFCONTR=>'40\' Reefer ',
            );
        }   
        
        /** 
         * Retrieves the various units of measurement
         * @return array an array of possible units of measurement
         */
        public function getPkgOptions()
        {
            return array(
                self::SUB_TYPE_WOODEN=>'Wooden',
                self::SUB_TYPE_CARDBOARD=>'Cardboard',
            );
        }          
}