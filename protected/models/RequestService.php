<?php

/**
 * This is the model class for table "{{request_service}}".
 *
 * The followings are the available columns in table '{{request_service}}':
 * @property string $request_ptr_id
 * @property string $official_dealer
 * @property string $nonofficial_dealer
 *
 * The followings are the available model relations:
 * @property Request $requestPtr
 */
class RequestService extends CActiveRecord
{
	const REQUEST_TYPE = 'service';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_service}}';
	}

	public function primaryKey() {
		return 'request_ptr_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_ptr_id', 'required'),
			array('request_ptr_id', 'length', 'max'=>10),
			array('official_dealer, nonofficial_dealer', 'length', 'max'=>2048),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('request_ptr_id, official_dealer, nonofficial_dealer', 'safe', 'on'=>'search'),
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
			'Request' => array(self::BELONGS_TO, 'Request', 'request_ptr_id'),
			'RequestServiceWorkRate' => array(self::HAS_MANY, 'RequestServiceWorkRate', array('request_ptr_id'=>'request_ptr_id')),
			'RequestServiceServeOrganisation' => array(self::HAS_MANY, 'RequestServiceServeOrganisation', array('request_ptr_id'=>'request_ptr_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'request_ptr_id' => 'Request Ptr',
			'official_dealer' => 'Official Dealer',
			'nonofficial_dealer' => 'Nonofficial Dealer',
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

		$criteria->compare('request_ptr_id',$this->request_ptr_id,true);
		$criteria->compare('official_dealer',$this->official_dealer,true);
		$criteria->compare('nonofficial_dealer',$this->nonofficial_dealer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getRequestServiceWorkRate()
	{
		$RequestServiceWorkRate = RequestServiceWorkRate::model()->findAll(
			"request_ptr_id = :request_ptr_id",
			array("request_ptr_id" => $this->request_ptr_id)
		);
		if ($RequestServiceWorkRate != null) {
			return $RequestServiceWorkRate;
		}
	}

	public function getRequestServiceServeOrganisation()
	{
		$RequestServiceServeOrganisation = RequestServiceServeOrganisation::model()->findAll(
			"request_ptr_id = :request_ptr_id",
			array("request_ptr_id" => $this->request_ptr_id)
		);
		if ($RequestServiceServeOrganisation != null) {
			return $RequestServiceServeOrganisation;
		}
	}
}
