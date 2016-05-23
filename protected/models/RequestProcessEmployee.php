<?php

/**
 * This is the model class for table "{{request_process_employee}}".
 *
 * The followings are the available columns in table '{{request_process_employee}}':
 * @property string $id
 * @property string $employee_id
 * @property string $request_process_id
 * @property string $created
 * @property string $finished
 */
class RequestProcessEmployee extends CActiveRecord
{
	/**
	 * Отчёт: кол-во обработанных заявок
	 * @var integer
	 */
	public $rowCount;

	/**
	 * Отчет: название отдела
	 * @var string
	 */
	public $name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_process_employee}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, request_process_id', 'required'),
			array('employee_id, request_process_id', 'length', 'max'=>10),
			array('created, finished', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_id, request_process_id, created, finished', 'safe', 'on'=>'search'),
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
			'Employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'request_process_id' => 'Request Process',
			'created' => 'Created',
			'finished' => 'Finished',
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
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('request_process_id',$this->request_process_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('finished',$this->finished,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestProcessEmployee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return bool
	 */
	public function isFinished()
	{
		if ($this->finished == NULL) {
			return false;
		}

		return true;
	}
}
