<?php

/**
 * This is the model class for table "{{request_tires}}".
 *
 * The followings are the available columns in table '{{request_tires}}':
 * @property string $request_ptr_id
 * @property integer $service_mounting
 * @property integer $service_tires_sale
 * @property integer $service_disk_sale
 * @property integer $serve_car
 * @property integer $serve_truck
 * @property integer $serve_tech
 * @property integer $sale_for_car
 * @property integer $sale_for_truck
 * @property integer $sale_for_tech
 *
 * The followings are the available model relations:
 * @property Request $requestPtr
 */
class RequestTires extends CActiveRecord
{
	const REQUEST_TYPE = 'tires';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{request_tires}}';
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
			array('service_mounting, service_tires_sale, service_disk_sale, serve_car, serve_truck, serve_tech, sale_for_car, sale_for_truck, sale_for_tech', 'numerical', 'integerOnly'=>true),
			array('request_ptr_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('request_ptr_id, service_mounting, service_tires_sale, service_disk_sale, serve_car, serve_truck, serve_tech, sale_for_car, sale_for_truck, sale_for_tech', 'safe', 'on'=>'search'),
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
			'RequestTiresServeOrganisation' => array(self::HAS_MANY, 'RequestTiresServeOrganisation', array('request_ptr_id'=>'request_ptr_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'request_ptr_id' => 'Request Ptr',
			'service_mounting' => 'Service Mounting',
			'service_tires_sale' => 'Service Tires Sale',
			'service_disk_sale' => 'Service Disk Sale',
			'serve_car' => 'Serve Car',
			'serve_truck' => 'Serve Truck',
			'serve_tech' => 'Serve Tech',
			'sale_for_car' => 'Sale For Car',
			'sale_for_truck' => 'Sale For Truck',
			'sale_for_tech' => 'Sale For Tech',
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
		$criteria->compare('service_mounting',$this->service_mounting);
		$criteria->compare('service_tires_sale',$this->service_tires_sale);
		$criteria->compare('service_disk_sale',$this->service_disk_sale);
		$criteria->compare('serve_car',$this->serve_car);
		$criteria->compare('serve_truck',$this->serve_truck);
		$criteria->compare('serve_tech',$this->serve_tech);
		$criteria->compare('sale_for_car',$this->sale_for_car);
		$criteria->compare('sale_for_truck',$this->sale_for_truck);
		$criteria->compare('sale_for_tech',$this->sale_for_tech);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RequestTires the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
