<?php

/**
 * This is the model class for table "job".
 *
 * The followings are the available columns in table 'job':
 * @property integer $id
 * @property string $REFNO
 * @property string $Client_REFNO
 * @property integer $client_id
 * @property string $status
 * @property string $init_date
 * @property integer $branch_id
 * @property integer $quote_id
 * @property integer $shipper
 * @property integer $consignee
 * @property integer $agent
 * @property integer $transporter
 * @property boolean $isActive 
 * @property string $cargo
 * @property string $packages
 * @property double $assessable_value
 * @property double $duty_value
 * @property string $duty_date
 * @property string $duty_mode
 * @property string $type
 * @property string $mode
 * @property string $terms
 * @property double $gross_weight
 * @property string $gross_weight_unit
 * @property double $nett_weight
 * @property string $nett_weight_unit
 * @property double $chargeable_weight
 * @property string $chargeable_weight_unit
 * @property string $document_references
 * @property string $origin
 * @property string $destination
 * @property string $transhipment
 * @property string $liner_carrier_name 
 * @property string $voyage_no
 * @property string $pickup_date
 * @property string $stuffing_date
 * @property string $BE_SB_no
 * @property string $BE_SB_date
 * @property string $bond_no
 * @property string $bond_date
 * @property string $bond_comments
 * @property string $onboard_date
 * @property string $transhipment_arrival_date
 * @property string $transhipment_date
 * @property string $arrival_date
 * @property integer $cfs_id
 * @property string $contr_nos
 * @property string $booking_ref 
 * @property string $mbl_mawb_no 
 * @property string $mbl_mawb_date 
 * @property string $hbl_hawb_no 
 * @property string $hbl_hawb_date 
 * @property string $cha_name
 * @property string $truck_nos
 * @property string $comments
 * @property integer $enquiry_by
 * @property integer $handled_by
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Job extends sifsActiveRecord
{
    
        /** constant definitions
         * 
         */
         const TYPE_IMPORT = 'IMPORT';
         const TYPE_EXPORT = 'EXPORT';
         const TYPE_DOMESTIC = 'DOMESTIC';
         const TYPE_MISC = 'MISC';
         
         const MODE_SEA_LCL = 'SEA LCL';
         const MODE_SEA_FCL = 'SEA FCL';
         const MODE_AIR = 'AIR';
         const MODE_COURIER = 'COURIER';
         const MODE_LAND = 'LAND';
                  
         const TERMS_EXW = 'EXW';
         const TERMS_FOB = 'FOB';
         const TERMS_CNF = 'CNF';
         const TERMS_CIF = 'CIF';
         const TERMS_DDU = 'DDU';
         const TERMS_DDP = 'DDP';
         
         // unit definitions should not cross 5 chars
         const UNIT_KGS = 'Kg(s)';
         const UNIT_MTS = 'MT(s)';
         const UNIT_CBM = 'CBM';
         const UNIT_CNTRS = 'CNTRs';
         
         public $shipp_search;
         public $conee_search;
         public $agnt_search;
         public $transporter_search;
         public $cfs_search;
         public $branch_search;
         public $client_search;


         /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Job the static model class
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
		return 'job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REFNO, client_id, init_date, branch_id, cargo, enquiry_by, handled_by', 'required'),
			array('branch_id, quote_id, shipper, consignee, agent, transporter, cfs_id, enquiry_by, handled_by, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('assessable_value, duty_value, gross_weight, nett_weight, chargeable_weight', 'numerical'),
			array('REFNO, Client_REFNO, origin, destination, transhipment, BE_SB_no, booking_ref, mbl_mawb_no, hbl_hawb_no', 'length', 'max'=>50),
			array('cargo, packages, bond_comments, liner_carrier_name, cha_name', 'length', 'max'=>100),
			array('duty_mode', 'length', 'max'=>10),
                        array('isActive','boolean'),
                        array('REFNO','unique'),
			array('type, mode', 'length', 'max'=>15),
			array('terms, gross_weight_unit, nett_weight_unit, chargeable_weight_unit', 'length', 'max'=>5),
			array('document_references, contr_nos, truck_nos', 'length', 'max'=>300),
			array('voyage_no', 'length', 'max'=>25),
			array('bond_no', 'length', 'max'=>20),
			array('comments', 'length', 'max'=>500),
			array('init_date, duty_date, pickup_date, stuffing_date, BE_SB_date, bond_date, onboard_date, transhipment_arrival_date, transhipment_date, arrival_date, mbl_mawb_date, hbl_hawb_date, created_on, updated_on', 'safe'),
                    	array('init_date, duty_date, pickup_date, stuffing_date, BE_SB_date, bond_date, onboard_date, transhipment_arrival_date, transhipment_date, arrival_date, mbl_mawb_date, hbl_hawb_date','date', 'format'=>array('yyyy-MM-dd',), 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, REFNO, Client_REFNO, init_date, branch_id, quote_id, shipper, consignee, agent, transporter, cargo, packages, assessable_value, duty_value, duty_date, duty_mode, type, mode, terms, gross_weight, gross_weight_unit, nett_weight, nett_weight_unit, chargeable_weight, chargeable_weight_unit, document_references, origin, destination, transhipment, voyage_no, pickup_date, stuffing_date, BE_SB_no, BE_SB_date, bond_no, bond_date, bond_comments, onboard_date, transhipment_arrival_date, transhipment_date, arrival_date, cfs_id, contr_nos, mbl_mawb_no, hbl_hawb_no, booking_ref, liner_carrier_name, cha_name, mbl_mawb_date, hbl_hawb_date, truck_nos, comments, enquiry_by, handled_by, created_by, created_on, updated_by, updated_on, shipp_search, conee_search, agnt_search, transporter_search, cfs_search, branch_search, client_search', 'safe', 'on'=>'search'),
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
                    'clients' => array(self::BELONGS_TO, 'Party', 'client_id'),
                    'shippers' => array(self::BELONGS_TO, 'Party','shipper'),
                    'consignees'=> array(self::BELONGS_TO, 'Party','consignee'),
                    'agents'=> array(self::BELONGS_TO, 'Party','agent'),
                    'transporters' => array(self::BELONGS_TO, 'Party', 'transporter'),
                    'cfses'=> array(self::BELONGS_TO, 'Party','cfs_id'),
                    'branches'=> array(self::BELONGS_TO, 'Branch', 'branch_id'),
                    'tasks'=> array(self::HAS_MANY, 'Task', 'job_id'),
                    'vouchers'=>array(self::HAS_MANY, 'Voucher', 'job_id'),
                    'invoices'=>array(self::HAS_MANY, 'Invoice', 'job_id'),
                    'packages'=>array(self::HAS_MANY, 'Package', 'job_id'),
                    'workorders'=>array(self::HAS_MANY, 'Workorder','job_id'),
                    'events'=>array(self::HAS_MANY, 'Jobevent', 'job_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'REFNO' => 'Refno',
			'Client_REFNO' => 'Client Refno',
			'init_date' => 'Initiated Date',
			'branch_id' => 'Branch',
                        'client_id' => 'Client',
			'quote_id' => 'Quote',
			'shipper' => 'Shipper',
			'consignee' => 'Consignee',
			'agent' => 'Agent',
                        'transporter' => 'Transporter',
                        'isActive' => 'Active?',
			'cargo' => 'Cargo Description',
			'packages' => 'Packages',
			'assessable_value' => 'Assessable Value',
			'duty_value' => 'Duty Value',
			'duty_date' => 'Duty Paid Date',
			'duty_mode' => 'Duty Mode',
			'type' => 'Type',
			'mode' => 'Mode',
			'terms' => 'Terms',
			'gross_weight' => 'Gross Weight',
			'gross_weight_unit' => 'Gross Weight Unit',
			'nett_weight' => 'Nett Weight',
			'nett_weight_unit' => 'Nett Weight Unit',
			'chargeable_weight' => 'Chargeable Weight',
			'chargeable_weight_unit' => 'Chargeable Weight Unit',
			'document_references' => 'Document References',
			'origin' => 'Origin',
			'destination' => 'Destination',
			'transhipment' => 'Transhipment',
			'liner_carrier_name' => 'Liner/Carrier Name',
			'voyage_no' => 'Voyage No',
			'pickup_date' => 'Pickup Date',
			'stuffing_date' => 'Stuffing Date',
			'BE_SB_no' => 'B.E / S.B No',
			'BE_SB_date' => 'B.E / S.B Date',
			'bond_no' => 'Bond No',
			'bond_date' => 'Bond Date',
                        'mbl_mawb_no' => 'MBL / MAWB No', 
                        'hbl_hawb_no' => 'HBL / HAWB No',
                        'mbl_mawb_date' => 'MBL / MAWB Date', 
                        'hbl_hawb_date' => 'HBL / HAWB Date',
			'bond_comments' => 'Bond Comments',
			'onboard_date' => 'Onboard Date',
			'transhipment_arrival_date' => 'Transhipment Arrival Date',
			'transhipment_date' => 'Transhipment Date',
			'arrival_date' => 'Arrival Date',
			'cfs_id' => 'Cfs',
			'contr_nos' => 'Contr Nos',
                        '$booking_ref' => 'Booking REF',
                        'cha_name' => 'CHA Name',
			'truck_nos' => 'Truck Nos',
			'comments' => 'Comments',
			'enquiry_by' => 'Enquiry By',
			'handled_by' => 'Handled By',
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'updated_by' => 'Updated By',
			'updated_on' => 'Updated On',
                        'shipp_search' => 'Shipper',
                        'conee_search' => 'Consignee',
                        'agnt_search' => 'Agent',
                        'transporter_search' => 'Transporter',
                        'cfs_search' => 'CFS',
                        'branch_search'=> 'Branch',
                        'client_search'=> 'Client',
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

                $criteria->with = array('shippers', 'consignees', 'agents', 'transporters', 'cfses', 'branches', 'clients');
		$criteria->compare('id',$this->id);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('REFNO',$this->REFNO,true);
		$criteria->compare('Client_REFNO',$this->Client_REFNO,true);
		$criteria->compare('init_date',$this->init_date,true);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('quote_id',$this->quote_id);
		$criteria->compare('shipper',$this->shipper);
		$criteria->compare('consignee',$this->consignee);
		$criteria->compare('agent',$this->agent);
                $criteria->compare('transporter', $this->transporter);
                $criteria->compare('isActive',$this->isActive,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('packages',$this->packages,true);
		$criteria->compare('assessable_value',$this->assessable_value);
		$criteria->compare('duty_value',$this->duty_value);
		$criteria->compare('duty_date',$this->duty_date,true);
		$criteria->compare('duty_mode',$this->duty_mode,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('terms',$this->terms,true);
		$criteria->compare('gross_weight',$this->gross_weight);
		$criteria->compare('gross_weight_unit',$this->gross_weight_unit,true);
		$criteria->compare('nett_weight',$this->nett_weight);
		$criteria->compare('nett_weight_unit',$this->nett_weight_unit,true);
		$criteria->compare('chargeable_weight',$this->chargeable_weight);
		$criteria->compare('chargeable_weight_unit',$this->chargeable_weight_unit,true);
		$criteria->compare('document_references',$this->document_references,true);
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('destination',$this->destination,true);
		$criteria->compare('transhipment',$this->transhipment,true);
		$criteria->compare('liner_carrier_name',$this->liner_carrier_name,true);
		$criteria->compare('voyage_no',$this->voyage_no,true);
		$criteria->compare('pickup_date',$this->pickup_date,true);
		$criteria->compare('stuffing_date',$this->stuffing_date,true);
		$criteria->compare('BE_SB_no',$this->BE_SB_no,true);
		$criteria->compare('BE_SB_date',$this->BE_SB_date,true);
		$criteria->compare('bond_no',$this->bond_no,true);
		$criteria->compare('bond_date',$this->bond_date,true);
		$criteria->compare('bond_comments',$this->bond_comments,true);
		$criteria->compare('onboard_date',$this->onboard_date,true);
		$criteria->compare('transhipment_arrival_date',$this->transhipment_arrival_date,true);
		$criteria->compare('transhipment_date',$this->transhipment_date,true);
		$criteria->compare('arrival_date',$this->arrival_date,true);
		$criteria->compare('cfs_id',$this->cfs_id);
		$criteria->compare('contr_nos',$this->contr_nos,true);
		$criteria->compare('booking_ref',$this->booking_ref,true);                        
		$criteria->compare('mbl_mawb_no',$this->mbl_mawb_no,true);
		$criteria->compare('mbl_mawb_date',$this->mbl_mawb_date,true);
		$criteria->compare('hbl_hawb_no',$this->hbl_hawb_no,true);
		$criteria->compare('hbl_hawb_date',$this->hbl_hawb_date,true);
		$criteria->compare('contr_nos',$this->contr_nos,true);
		$criteria->compare('cha_name',$this->cha_name,true);
                
		$criteria->compare('truck_nos',$this->truck_nos,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('enquiry_by',$this->enquiry_by);
		$criteria->compare('handled_by',$this->handled_by);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);
                $criteria->compare('shippers.party_name',$this->shipp_search,true);
                $criteria->compare('consignees.party_name',$this->conee_search,true);
                $criteria->compare('agents.party_name',$this->agnt_search,true);
                $criteria->compare('transporters.party_name',$this->transporter_search,true);
                $criteria->compare('cfses.party_name',  $this->cfs_search,true);
                $criteria->compare('branches.branch_name', $this->branch_search,true);
                $criteria->compare('clients.party_name', $this->client_search,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array(
                            'attributes' => 
                                array(
                                    'shipp_search' => array(
                                        'asc' => 'shippers.party_name',
                                        'desc' => 'shippers.party_name DESC',
                                    ),
                                   'conee_search' => array(
                                        'asc' => 'consignees.party_name',
                                        'desc' => 'consignees.party_name DESC',
                                    ),
                                    'agnt_search' => array(
                                        'asc' => 'agents.party_name',
                                        'desc' => 'agents.party_name DESC',
                                    ),
                                    'transporter_search' => array(
                                        'asc' => 'transporters.party_name',
                                        'desc' => 'transporters.party_name DESC',
                                    ),                                    
                                    'cfs_search' => array(
                                        'asc' => 'cfses.party_name',
                                        'desc' => 'cfses.party_name DESC',
                                    ), 
                                    'client_search' => array(
                                        'asc' => 'clients.party_name',
                                        'desc' => 'clients.party_name DESC',
                                    ),
                                    '*',
                                ),
                        ),
                        'pagination'=> array(
                            'pageSize' => 50,
                        )
		));
	}
        
        /** 
         * Retrieves the various shipment types
         * @return array an array of possible shipment types
         */
        public static function getTypeOptions()
        {
            return array(
                self::TYPE_IMPORT=>'Import',
                self::TYPE_EXPORT=>'Export',
                self::TYPE_DOMESTIC=>'Domestic',
                self::TYPE_MISC=>'Misc',
            );
        }
        
        /** 
         * Retrieves the various shipment modes
         * @return array an array of possible shipment modes
         */
        public static function getModeOptions()
        {
            return array(
                self::MODE_SEA_LCL=>'SEA LCL',
                self::MODE_SEA_FCL=>'SEA FCL',                
                self::MODE_AIR=>'AIR',
                self::MODE_COURIER=>'COURIER',
                self::MODE_LAND=>'LAND',
            );
        }
        
        /** 
         * Retrieves the various INCO terms
         * @return array an array of possible inco terms
         */
        public function getTermsOptions()
        {
            return array(
                self::TERMS_CIF=>'CIF',
                self::TERMS_CNF=>'CNF',
                self::TERMS_DDP=>'DDP',
                self::TERMS_DDU=>'DDU',
                self::TERMS_EXW=>'EXW',
                self::TERMS_FOB=>'FOB',
            );
        }
        
        /** 
         * Retrieves the various units of measurement
         * @return array an array of possible units of measurement
         */
        public function getUnitsOptions()
        {
            return array(
                self::UNIT_CBM=>'CBM',
                self::UNIT_KGS=>'Kilogram(s)',
                self::UNIT_MTS=>'Metric Tonne(s)',
                self::UNIT_CNTRS=>'Containers',

            );
        }

        /** 
         * Retrieves the Parties for populating the Shipper/Conee/Agent fields
         * @return array an array of all parties
         */
        public function getPartyOptions()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'is_blacklisted = 0';
            $partiesArray = CHtml::listData(Party::model()->findAll($criteria),'id','party_name');
            return $partiesArray;
        }
        
         /** 
         * Retrieves the Parties for populating the CFS/Transporter fields
         * @return array an array of all parties
         */
        public function getCFSOptions()
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'is_blacklisted = 0 AND party_type ="'.Party::TYPE_CFS.'"';
            $partiesArray = CHtml::listData(Party::model()->findAll($criteria),'id','party_name');
            return $partiesArray;
        }   
        
        /** 
         * Retrieves the Parties for populating the Shipper/Conee/Agent fields
         * @return array an array of all parties
         */
        public function getUserOptions()
        {
            $criteria = new CDbCriteria();
            $usersArray = CHtml::listData(User::model()->findAll($criteria),'id','username');
            return $usersArray;
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
         * Retrieves the Branches for populating the Branch field
         * @return array an array of all Branches
         */
        public function getBranchOptions()
        {
            $branchesArray = CHtml::listData(Yii::app()->session['branches'],'id','branch_name');
            return $branchesArray;

        }
        
        /** 
         * Retrieves the REF No of the latest job
         * @return string the latest Job REF No as a string
         */
        public function getLatestJobREF()
        {
            $criteria = new CDbCriteria(); 
            $criteria->select = 'REFNO';
            $criteria->condition = 'created_on = (select max(created_on) from job)';
            $latestJob = Job::model()->find($criteria);
            if (!empty($latestJob)) 
                return $latestJob->REFNO; 
            else 
                return 0;
        }

        /** 
         * Retrieves the REF No of the latest job
         * @return string the latest Job REF No as a string
         */
        public function createJobREF()
        {
            $latestJobREFNo = Job::model()->getLatestJobREF();
            $jobREFFNO = 'CMPYYYY00000';
            if ($latestJobREFNo!='' || $latestJobREFNo!=0) {
                $numpart = substr($latestJobREFNo,-4)+1;
                $jobREFFNO = substr($latestJobREFNo,0,-4).$numpart;
            }
            return $jobREFFNO;
        }
        
        /**
         * Method to do some data massaging before being input to DB
         * @return Original ActiveRecord's beforeSave
         */
        protected function beforeSave() {
            // code to make the empty dates to NULL to allow saving to the DB
            
            if ($this->duty_date == '')
                $this->duty_date = NULL;
            if ($this->pickup_date == '')
                $this->pickup_date = NULL;
            if ($this->stuffing_date == '')
                $this->stuffing_date = NULL;
            if ($this->onboard_date == '')
                $this->onboard_date = NULL;
            if ($this->transhipment_arrival_date == '')
                $this->transhipment_arrival_date = NULL;
            if ($this->transhipment_date == '')
                $this->transhipment_date = NULL;
            if ($this->arrival_date == '')
                $this->arrival_date = NULL;
            if ($this->bond_date == '')
                $this->bond_date = NULL;
            if ($this->BE_SB_date == '')
                $this->BE_SB_date = NULL;
            if ($this->transhipment_date == '')
                $this->transhipment_date = NULL;
            if ($this->transhipment_date == '')
                $this->transhipment_date = NULL;
            if ($this->mbl_mawb_date == '')
                $this->mbl_mawb_date = NULL;
            if ($this->hbl_hawb_date == '')
                $this->hbl_hawb_date = NULL;           

            return parent::beforeSave();
        }
}