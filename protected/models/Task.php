<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $job_id
 * @property string $description
 * @property string $comments
 * @property integer $owner_id
 * @property integer $allotted_by
 * @property integer $allotted_to
 * @property string $due_date
 * @property string $status
 * @property string $priority
 * @property integer $transferred_to
 * @property string $transfer_reason
 * @property string $completed_on
 * @property string $complete_comments
 * @property integer $rating
 * @property string $closed_on
 * @property string $closure_comments
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Task extends sifsActiveRecord
{
    
        /** constant definitions
         * 
         */
         const STATUS_CLOSED = 'CLOSED';
         const STATUS_REOPEN = 'REOPENED';
         const STATUS_PENDING = 'PENDING';    
         const STATUS_COMPLETED = 'COMPLETED';    
         
         const PRIORITY_LOW = 'LOW'; 
         const PRIORITY_MEDIUM = 'MEDIUM';    
         const PRIORITY_HIGH = 'HIGH';    

         const RANK_1 = '1'; 
         const RANK_2 = '2';    
         const RANK_3 = '3';    
         const RANK_4 = '4';    
         const RANK_5 = '5';    

         
         
         /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, allotted_by', 'required'),
			array('job_id, owner_id, allotted_by, allotted_to, transferred_to, rating, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('description, transfer_reason, complete_comments, closure_comments', 'length', 'max'=>300),
			array('comments', 'length', 'max'=>500),
			array('status', 'length', 'max'=>30),
			array('priority', 'length', 'max'=>10),
			array('due_date, completed_on, closed_on, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_id, description, comments, owner_id, allotted_by, allotted_to, due_date, status, priority, transferred_to, transfer_reason, completed_on, complete_comments, rating, closed_on, closure_comments, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'owners'=>array(self::BELONGS_TO, 'User', 'owner_id'),
                    'allotters'=>array(self::BELONGS_TO, 'User', 'allotted_by'),
                    'allottees'=>array(self::BELONGS_TO, 'User', 'allotted_to'),
                    'transferors'=>array(self::BELONGS_TO, 'User', 'transferred_to'),
                    'jobs' => array(self::BELONGS_TO, 'Job', 'job_id'),                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_id' => 'Job',
			'description' => 'Description',
			'comments' => 'Comments',
			'owner_id' => 'Owner',
			'allotted_by' => 'Allotted By',
			'allotted_to' => 'Allotted To',
			'due_date' => 'Due Date',
			'status' => 'Status',
			'priority' => 'Priority',
			'transferred_to' => 'Transferred To',
			'transfer_reason' => 'Transfer Reason',
			'completed_on' => 'Completed On',
			'complete_comments' => 'Completion Comments',
			'rating' => 'Rating',
			'closed_on' => 'Closed On',
			'closure_comments' => 'Closure Comments',
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
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('allotted_by',$this->allotted_by);
		$criteria->compare('allotted_to',$this->allotted_to);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('transferred_to',$this->transferred_to);
		$criteria->compare('transfer_reason',$this->transfer_reason,true);
		$criteria->compare('completed_on',$this->completed_on,true);
		$criteria->compare('complete_comments',$this->complete_comments,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('closed_on',$this->closed_on,true);
		$criteria->compare('closure_comments',$this->closure_comments,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        /** 
         * Retrieves the various statuses of task
         * @return array an array of possible statuses of task
         */
        public function getStatusOptions()
        {
            return array(
                self::STATUS_PENDING=>'PENDING',
                self::STATUS_COMPLETED=>'COMPLETED',
                self::STATUS_REOPEN=>'REOPENED',
                self::STATUS_CLOSED=>'CLOSED',
            );
        }
   
        /** 
         * Retrieves the various priorities of task
         * @return array an array of possible priorities of task
         */
        public function getPriorityOptions()
        {
            return array(
                self::PRIORITY_LOW=>'LOW',
                self::PRIORITY_MEDIUM=>'MEDIUM',
                self::PRIORITY_HIGH=>'HIGH',

            );
        } 
         
        
        /** 
         * Retrieves the various ranks of task completion
         * @return array an array of possible ranks of task completion
         */
        public function getRankingOptions()
        {
            return array(
                self::RANK_1=>'Very Bad',
                self::RANK_2=>'Bad',
                self::RANK_3=>'Average',
                self::RANK_4=>'Good',
                self::RANK_5=>'Excellent',
            );
        }  
        
        /**
         * Method to do some data massaging before being input to DB
         * @return Original ActiveRecord's beforeSave
         */
        protected function beforeSave() {
            // code to make the empty dates to NULL to allow saving to the DB
            
            if ($this->due_date == '')
                $this->due_date = NULL;
            if ($this->completed_on == '')
                $this->completed_on = NULL;
            if ($this->closed_on == '')
                $this->closed_on = NULL;
            

            return parent::beforeSave();
        }
                      
}