<?php

/**
 * This is the model class for table "{{request_service_work_rate}}".
 *
 * The followings are the available columns in table '{{request_service_work_rate}}':
 * @property integer $id
 * @property integer $request_ptr_id
 * @property string $work_name
 * @property string $rate
 */
class RequestServiceWorkRate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_service_work_rate}}';
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
			array('request_ptr_id', 'numerical', 'integerOnly'=>true),
			array('work_name', 'length', 'max'=>256),
			array('rate', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_ptr_id, work_name, rate', 'safe', 'on'=>'search'),
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
			'request_ptr_id' => 'Request Ptr',
			'work_name' => 'Work Name',
			'rate' => 'Rate',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('request_ptr_id',$this->request_ptr_id);
		$criteria->compare('work_name',$this->work_name,true);
		$criteria->compare('rate',$this->rate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestServiceWorkRate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
