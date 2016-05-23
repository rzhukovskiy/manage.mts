<?php

/**
 * This is the model class for table "{{employee}}".
 *
 * The followings are the available columns in table '{{employee}}':
 * @property integer $id
 * @property integer $employee_group_id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $create_date
 * @property string $role
 */
class Employee extends CActiveRecord
{
	const ADMIN_ROLE   = 'admin';
	const EMPLOYEE_ROLE = 'employee';
	const GUEST_ROLE   = 'guest';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{employee}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_group_id, username, password', 'required'),
			array('employee_group_id', 'numerical', 'integerOnly'=>true),
			array('employee_group_id, username, password', 'length', 'max'=>32),
			array('role', 'length', 'max'=>8),
			array('create_date', 'safe'),
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
			'EmployeeGroup'=>array(self::BELONGS_TO, 'EmployeeGroup', 'employee_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_group_id' => 'Отдел',
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'salt' => 'Salt',
			'create_date' => 'Дата добавления',
			'role' => 'Role',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('employee_group_id',$this->employee_group_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
		$PasswordLib = new Password($password);
		$PasswordLib->setSalt($this->salt);

		return $PasswordLib->hashPassword() === $this->password;
	}
}
