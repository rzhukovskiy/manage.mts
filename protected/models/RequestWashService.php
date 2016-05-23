<?php

/**
 * This is the model class for table "{{request_wash_service}}".
 *
 * The followings are the available columns in table '{{request_wash_service}}':
 * @property string $id
 * @property string $request_ptr_id
 * @property string $type
 * @property string $price_outside
 * @property string $price_inside
 */
class RequestWashService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_wash_service}}';
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
			array('type', 'length', 'max'=>128),
			array('price_outside, price_inside', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_ptr_id, type, price_outside, price_inside', 'safe', 'on'=>'search'),
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
			'type' => 'Тип ТС',
			'price_outside' => 'Цена снаружи',
			'price_inside' => 'Цена внутри',
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
		$criteria->compare('request_ptr_id',$this->request_ptr_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('price_outside',$this->price_outside,true);
		$criteria->compare('price_inside',$this->price_inside,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestWashService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
