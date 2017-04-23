<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $subtype1
 * @property string $subtype2
 * @property string $subtype3
 * @property integer $order_no
 * @property integer $flag
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
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
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_no, flag', 'numerical', 'integerOnly'=>true),
			array('name, type, subtype1, subtype2, subtype3', 'length', 'max'=>50),
			array('description', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, type, subtype1, subtype2, subtype3, order_no, flag', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'type' => 'Type',
			'subtype1' => 'Subtype1',
			'subtype2' => 'Subtype2',
			'subtype3' => 'Subtype3',
			'order_no' => 'Order No',
			'flag' => 'Flag',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('subtype1',$this->subtype1,true);
		$criteria->compare('subtype2',$this->subtype2,true);
		$criteria->compare('subtype3',$this->subtype3,true);
		$criteria->compare('order_no',$this->order_no);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}