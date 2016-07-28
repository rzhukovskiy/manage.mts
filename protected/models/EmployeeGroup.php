<?php

/**
 * This is the model class for table "{{employee_group}}".
 *
 * The followings are the available columns in table '{{employee_group}}':
 * @property integer $id
 * @property string $name
 * @property integer $manage
 */
class EmployeeGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{employee_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>32),
			array('manage', 'numerical', 'integerOnly'=>true),
			array('id, name, manage', 'safe', 'on'=>'search'),
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
			'EmployeeGroupRequestType' => array(self::HAS_ONE, 'EmployeeGroupRequestType', 'employee_group_id'),
			'EmployeeGroupArchiveRequestType' => array(self::HAS_ONE, 'EmployeeGroupArchiveRequestType', 'employee_group_id'),
			'Message' => array(self::HAS_MANY, 'Message', 'to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название отдела',
			'manage' => 'Управление заявками',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('manage',$this->manage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeeGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNewMessages($employeeId)
	{
		return count(Message::model()->with('Author')->findAll('`to` = :to AND employee_group_id = :employee_group_id AND is_read = 0', [
			':employee_group_id' => $this->id,
			':to' => $employeeId,
		]));
	}
}
