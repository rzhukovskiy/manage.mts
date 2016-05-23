<?php

/**
 * This is the model class for table "{{employee_group_request_type}}".
 *
 * The followings are the available columns in table '{{employee_group_request_type}}':
 * @property string $id
 * @property string $employee_group_id
 * @property integer $service
 * @property integer $tires
 * @property integer $wash
 * @property integer $company
 */
class EmployeeGroupRequestType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{employee_group_request_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_group_id', 'required'),
			array('service, tires, wash, company', 'numerical', 'integerOnly'=>true),
			array('employee_group_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_group_id, service, tires, wash, company', 'safe', 'on'=>'search'),
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
			'employee_group_id' => 'Employee Group',
			'service' => 'Service',
			'tires' => 'Tires',
			'wash' => 'Wash',
			'company' => 'Company',
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
		$criteria->compare('employee_group_id',$this->employee_group_id,true);
		$criteria->compare('service',$this->service);
		$criteria->compare('tires',$this->tires);
		$criteria->compare('wash',$this->wash);
		$criteria->compare('company',$this->company);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeeGroupRequestType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
