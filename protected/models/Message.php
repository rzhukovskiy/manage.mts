<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property int $id
 * @property string $text
 * @property string $create_date
 * @property int $from
 * @property int $to
 * @property int $is_read
 *
 * The followings are the available model relations:
 * @property Employee $Employee
 * @property EmployeeGroup $EmployeeGroup
 */
class Message extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{message}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['text, from, to','required'],
            ['create_date, is_read','safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'from' => 'Автор',
            'to' => 'Кому',
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'Employee' => [self::HAS_ONE, 'Employee', 'from'],
            'EmployeeGroup' => [self::HAS_ONE, 'EmployeeGroup', 'to'],
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('from', $this->from);
        $criteria->compare('to', $this->to);
        $criteria->compare('create_date', $this->create_date);
        $criteria->compare('is_read', $this->is_read);

        $sort = new CSort;
        $sort->attributes = ['create_date'];
        $sort->defaultOrder = 'create_date DESC';
        $sort->applyOrder($criteria);


        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => $sort,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }
}