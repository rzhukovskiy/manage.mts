<?php

/**
 * This is the model class for table "{{request}}".
 *
 * The followings are the available columns in table '{{request}}':
 * @property string $id
 * @property string $new
 * @property string $name
 * @property string $address_timezone
 * @property string $address_index
 * @property string $address_city
 * @property string $address_street
 * @property string $address_house
 * @property string $address_phone
 * @property string address_mail
 * @property string $time_from
 * @property string $time_to
 * @property string $director_name
 * @property string $director_email
 * @property string $director_phone
 * @property string $doc_name
 * @property string $doc_email
 * @property string $doc_phone
 * @property string $next_communication_date
 * @property string $payment_day
 * @property string email
 * @property string agreement_number
 * @property string agreement_date
 * @property string agreement_file
 * @property string status
 *
 * The followings are the available model relations:
 * @property RequestService[] $requestServices
 * @property RequestTires[] $requestTires
 * @property RequestWash[] $requestWashes
 */
class Request extends CActiveRecord
{
	public static $request_russian = [
		RequestWash::REQUEST_TYPE => 'Мойки',
		RequestService::REQUEST_TYPE => 'Сервис',
		RequestTires::REQUEST_TYPE => 'Шиномонтаж',
		RequestCompany::REQUEST_TYPE => 'Компании'
	];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address_street', 'length', 'max'=>128),
			array('address_index', 'length', 'max'=>32),
			array('address_city, director_email, doc_email', 'length', 'max'=>32),
			array('address_house, address_phone, director_phone, doc_phone', 'length', 'max'=>255),
			array('address_mail', 'length', 'max'=>1024),
			array('director_name, doc_name', 'length', 'max'=>256),
			array('address_timezone', 'length', 'max'=>32),
			array('time_from, time_to', 'length', 'max'=>32),
			array('next_communication_date', 'length', 'max'=>10),
			array('payment_day', 'length', 'max'=>'64'),
			array('email', 'length', 'max'=>128),
			array('agreement_number', 'length', 'max'=>255),
			array('agreement_date,', 'length', 'max'=>10),
			array('agreement_file,', 'length', 'max'=>256),
			array('status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address_timezone, address_index, address_city, address_street, address_house, address_phone, address_mail, time_from, time_to, director_name, director_email, director_phone, doc_name, doc_email, doc_phone, next_communication_date, payment_day, email, agreement_number, agreement_date, agreement_file, status', 'safe', 'on'=>'search'),
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
			'RequestCompany' => array(self::HAS_ONE, 'RequestCompany', 'request_ptr_id'),
			'RequestService' => array(self::HAS_ONE, 'RequestService', 'request_ptr_id'),
			'RequestTires' => array(self::HAS_ONE, 'RequestTires', 'request_ptr_id'),
			'RequestWash' => array(self::HAS_ONE, 'RequestWash', 'request_ptr_id'),

			'RequestEmployee' => array(self::HAS_MANY, 'RequestEmployee', array('request_id'=>'id')),
			'RequestComments' => array(self::HAS_MANY, 'RequestComments', array('request_id'=>'id')),

			'RequestProcess' => array(self::HAS_ONE, 'RequestProcess', 'request_id'),
			'RequestDone' => array(self::HAS_ONE, 'RequestDone', 'request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'address_timezone' => 'Временная зона',
			'address_index' => 'Индекс',
			'address_city' => 'Город',
			'address_street' => 'Улица',
			'address_house' => 'Дом',
			'address_phone' => 'Телефон',
			'address_mail' => 'Почтовый адрес',
			'time_from' => 'Начало рабочего дня',
			'time_to' => 'Конец рабочего дня',
			'director_name' => 'Имя',
			'director_email' => 'Email',
			'director_phone' => 'Телефон',
			'doc_name' => 'Имя',
			'doc_email' => 'Email',
			'doc_phone' => 'Телефон',
			'next_communication_date' => 'Дата следующей связи',
			'payment_day' => 'Банковские дни оплаты по договору',
			'email' => 'Официальный адрес эл. почты',
			'agreement_number' => 'Номер договора',
			'agreement_date' => 'Дата заключения договора',
			'agreement_file' => 'Скан договора',
			'status' => 'Статус клиента'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address_timezone',$this->address_timezone,true);
		$criteria->compare('address_index',$this->address_index,true);
		$criteria->compare('address_city',$this->address_city,true);
		$criteria->compare('address_street',$this->address_street,true);
		$criteria->compare('address_house',$this->address_house,true);
		$criteria->compare('address_phone',$this->address_phone,true);
		$criteria->compare('address_mail',$this->address_mail,true);
		$criteria->compare('time_from',$this->time_from,true);
		$criteria->compare('time_to',$this->time_to,true);
		$criteria->compare('director_name',$this->director_name,true);
		$criteria->compare('director_email',$this->director_email,true);
		$criteria->compare('director_phone',$this->director_phone,true);
		$criteria->compare('doc_name',$this->doc_name,true);
		$criteria->compare('doc_email',$this->doc_email,true);
		$criteria->compare('doc_phone',$this->doc_phone,true);
		$criteria->compare('next_communication_date',$this->next_communication_date,true);
		$criteria->compare('payment_day',$this->payment_day,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('agreement_number',$this->agreement_number,true);
		$criteria->compare('agreement_date',$this->agreement_date,true);
		$criteria->compare('agreement_file',$this->agreement_file,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getTranslate($type = null)
	{
		if ($type !== null) {
			return self::$request_russian[$type];
		}

		return null;
	}

	public function getNextCommunicationDate()
	{
		$formatDate = date("d.m.y", strtotime($this->next_communication_date));

		if ($this->next_communication_date === null) {
			$nextCommunicationDate = "<div>не указана</div>";
		} elseif ($this->next_communication_date <= date('Y-m-d')) {
			$nextCommunicationDate = "<div style='color: red;'>" . $formatDate . "</div>";
		} else {
			$nextCommunicationDate = "<div>" . $formatDate . "</div>";
		}

		return $nextCommunicationDate;
	}

	public function getFullAddress()
	{
		$fullAddress = [];

		if ($this->address_index !== '' and $this->address_index !== null)
			$fullAddress[] = $this->address_index;

		if ($this->address_city !== '' and $this->address_city !== null)
			$fullAddress[] = $this->address_city;

		if ($this->address_street !== '' and $this->address_street !== null)
			$fullAddress[] = $this->address_street;

		if ($this->address_house !== '' and $this->address_house !== null)
			$fullAddress[] = $this->address_house;

		return implode(', ', $fullAddress);
	}

	public function getInstance()
	{
		try {
			$Instance = Instance::init($this->id);
		} catch(\Exception $e) {

		}

		return $Instance;
	}

	public function getName()
	{
		if ($this->name === null) {
			return '';
		}

		return $this->name;
	}

	public function isAddressCity()
	{
		if ($this->address_city === null) {
			return false;
		}

		return true;
	}


	/**
	 * @return string REQUEST_TYPE
	 */
	public function getRequestType()
	{
		$Model = Instance::detectType($this->id);

		if ($Model) {
			return $Model::REQUEST_TYPE;
		} else {
			return 'company';
		}
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function getCompanyPrices()
	{
		$Autopark = new RequestCompanyAutopark();
		$Autopark->request_ptr_id = $this->id;

		return $Autopark->search();
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function getWashPrices()
	{
		$Autopark = new RequestWashService();
		$Autopark->request_ptr_id = $this->id;

		return $Autopark->search();
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function getCompanyCars()
	{
		$Autopark = new RequestCompanyListAuto();
		$Autopark->request_ptr_id = $this->id;

		return $Autopark->search();
	}

	/**
	 * @return bool
	 */
	public function afterSave()
	{
		if ($this->isNewRecord) {
			if (isset($this->director_name) || isset($this->director_phone) || isset($this->director_email)) {
				$RequestEmployee = new RequestEmployee();
				$RequestEmployee->request_id = $this->id;
				$RequestEmployee->position 	 = 'Директор';
				$RequestEmployee->name  	 = $this->director_name;
				$RequestEmployee->phone 	 = $this->director_phone;
				$RequestEmployee->email 	 = $this->director_email;

				$RequestEmployee->save();
			}

			if (isset($this->doc_name) || isset($this->doc_phone) || isset($this->doc_email)) {
				$RequestEmployee = new RequestEmployee();
				$RequestEmployee->request_id = $this->id;
				$RequestEmployee->position 	 = 'Ответственный за договорную работу';
				$RequestEmployee->name  	 = $this->doc_name;
				$RequestEmployee->phone 	 = $this->doc_phone;
				$RequestEmployee->email 	 = $this->doc_email;

				$RequestEmployee->save();
			}
		}

		return true;
	}
}
