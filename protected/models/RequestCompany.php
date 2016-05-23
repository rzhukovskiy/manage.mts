<?php

/**
 * This is the model class for table "{{request_company}}".
 *
 * The followings are the available columns in table '{{request_company}}':
 * @property string $request_ptr_id
 * @property string $contact_name
 * @property string $phone
 * @property string $email
 * @property string $city
 */
class RequestCompany extends CActiveRecord
{
	const REQUEST_TYPE = 'company';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_company}}';
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
			array('contact_name', 'length', 'max'=>256),
			array('phone', 'length', 'max'=>16),
			array('email', 'length', 'max'=>32),
			array('city', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('request_ptr_id, contact_name, phone, email, city', 'safe', 'on'=>'search'),
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
			'RequestCompanyAutopark' => array(self::HAS_MANY, 'RequestCompanyAutopark', array('request_ptr_id'=>'request_ptr_id')),
			'RequestCompanyListAuto' => array(self::HAS_MANY, 'RequestCompanyListAuto', array('request_ptr_id'=>'request_ptr_id')),
			'RequestCompanyDriver' => array(self::HAS_MANY, 'RequestCompanyDriver', array('request_ptr_id'=>'request_ptr_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'request_ptr_id' => 'Request Ptr',
			'contact_name' => 'ФИО контактного лица',
			'phone' => 'Телефон контактного лица',
			'email' => 'Email контактного лица',
			'city' => 'Города где работает компания'
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
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
