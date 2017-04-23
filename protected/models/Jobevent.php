<?php

/**
 * This is the model class for table "jobevent".
 *
 * The followings are the available columns in table 'jobevent':
 * @property integer $id
 * @property integer $job_id
 * @property integer $event_id
 * @property string $event_date
 * @property string $document_ref
 * @property string $comments
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 */
class Jobevent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jobevent the static model class
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
		return 'jobevent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_id, event_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('document_ref', 'length', 'max'=>50),
                        array('event_date','required'),
			array('comments', 'length', 'max'=>300),
			array('event_date, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_id, event_id, event_date, document_ref, comments, created_by, created_on, updated_by, updated_on', 'safe', 'on'=>'search'),
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
                    'events'=>array(self::BELONGS_TO, 'Event', 'event_id'),
                    'jobs'=>array(self::BELONGS_TO, 'Job', 'job_id'),
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
			'event_id' => 'Event',
			'event_date' => 'Event Date',
			'document_ref' => 'Document Ref',
			'comments' => 'Comments',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('document_ref',$this->document_ref,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}