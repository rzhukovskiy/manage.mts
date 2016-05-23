<?php

/**
 * This is the model class for table "{{request_process}}".
 *
 * The followings are the available columns in table '{{request_process}}':
 * @property string $id
 * @property string $request_id
 * @property string $employee_group_id
 * @property string $updated
 */
class RequestProcess extends CActiveRecord
{
	public $request_name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_process}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_id, employee_group_id, updated', 'required'),
			array('request_id, employee_group_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, employee_group_id, updated, request_name', 'safe', 'on'=>'search'),
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
			'RequestProcessEmployee' => array(self::HAS_MANY, 'RequestProcessEmployee', 'request_process_id'),

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
			'employee_group_id' => 'Employee Group',
			'updated' => 'Updated'
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

		$criteria->with = array('Request');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('employee_group_id',$this->employee_group_id,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 50,
			),
			'sort' => array(
				'defaultOrder' => 't.id DESC',
				'attributes' => array(
					'request_name' => array(
						'asc' => 'Request.name',
						'desc' => 'Request.name DESC'
					)
				)
			)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestProcess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return mixed
	 */
	public function getLastEmployee()
	{
		$requestId = $this->id;

		/** @var RequestProcessEmployee $RequestProcessEmployee */
		$RequestProcessEmployee = RequestProcessEmployee::model()->find(array(
			"condition" => "request_process_id = :request_process_id",
			"params" => array(":request_process_id" => $requestId),
			"order" => "id DESC"
		));
		if ($RequestProcessEmployee == null) {
			return false;
		}

		return $RequestProcessEmployee;
	}
}
