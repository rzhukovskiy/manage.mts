<?php

/**
 * This is the model class for table "{{request_done}}".
 *
 * The followings are the available columns in table '{{request_done}}':
 * @property string $id
 * @property string $request_id
 * @property string $created
 */
class RequestDone extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_done}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_id', 'required'),
			array('request_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, created', 'safe', 'on'=>'search'),
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
			'Request' => array(self::BELONGS_TO, 'Request', 'request_id'),
			'RequestEmployee' => array(self::HAS_MANY, 'RequestEmployee', array('request_id'=>'request_id')),
			'RequestComments' => array(self::HAS_MANY, 'RequestComments', array('request_id'=>'request_id')),

			'RequestCompany' => array(self::HAS_ONE, 'RequestCompany', array('request_ptr_id'=>'request_id')),
			'RequestService' => array(self::HAS_ONE, 'RequestService', array('request_ptr_id'=>'request_id')),
			'RequestTires' => array(self::HAS_ONE, 'RequestTires', array('request_ptr_id'=>'request_id')),
			'RequestWash' => array(self::HAS_ONE, 'RequestWash', array('request_ptr_id'=>'request_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestDone the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string REQUEST_TYPE
	 */
	public function getRequestType()
	{
		$Model = Instance::detectType($this->request_id);

		return $Model::REQUEST_TYPE;
	}
}
