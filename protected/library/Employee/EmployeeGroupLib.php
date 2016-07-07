<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 24.04.2016
 * Time: 13:35
 */

/**
 * Class EmployeeGroups
 */
class EmployeeGroupLib
{
    /** @var Employee */
    private $Employee;

    public function __construct($Employee)
    {
        $this->Employee = $Employee;
    }

    /**
     * @param $attributes
     * @param $attributesType
     * @param $attributesArchive
     * @return EmployeeGroup
     * @throws Exception
     */
    public function create($attributes, $attributesType, $attributesArchive)
    {
        $EmployeeGroup = new EmployeeGroup;

        $EmployeeGroup->attributes = $attributes;
        if(!$EmployeeGroup->save()) {
            throw new \Exception(CHtml::errorSummary($EmployeeGroup));
        }

        $EmployeeGroupRequestType = new EmployeeGroupRequestType();
        $EmployeeGroupRequestType->employee_group_id = $EmployeeGroup->id;
        $EmployeeGroupRequestType->attributes = $this->compParams($attributesType);
        $EmployeeGroupRequestType->save();

        $EmployeeGroupArchiveRequestType = new EmployeeGroupArchiveRequestType();
        $EmployeeGroupArchiveRequestType->employee_group_id = $EmployeeGroup->id;
        $EmployeeGroupArchiveRequestType->attributes = $this->compParams($attributesArchive);
        $EmployeeGroupArchiveRequestType->save();

        return $EmployeeGroup;
    }

    /**
     * @param $id
     * @param $attributes
     * @param $attributesType
     * @param $attributesArchive
     * @return bool|EmployeeGroup
     * @throws Exception
     */
    public function update($id, $attributes, $attributesType, $attributesArchive)
    {
        $EmployeeGroup = $this->loadModel($id);
        if (!$EmployeeGroup) {
            throw new \Exception('Отдел не найден');
        }

        $EmployeeGroup->name = $attributes["name"];
        if (array_key_exists("manage", $attributes)) {
            $EmployeeGroup->manage = 1;
        } else {
            $EmployeeGroup->manage = 0;
        }
        if(!$EmployeeGroup->save()) {
            throw new \Exception(CHtml::errorSummary($EmployeeGroup));
        }

        /** @var $EmployeeGroupRequestType EmployeeGroupRequestType */
        $EmployeeGroupRequestType = EmployeeGroupRequestType::model()->find(array(
            "condition" => "employee_group_id = :employee_group_id",
            "params" => array(
                ":employee_group_id" => $id
            )
        ));
        if ($EmployeeGroupRequestType === null) {
            $EmployeeGroupRequestType = new EmployeeGroupRequestType();
            $EmployeeGroupRequestType->employee_group_id = $EmployeeGroup->id;
        }

        $EmployeeGroupRequestType->attributes = $this->compParams($attributesType);
        $EmployeeGroupRequestType->save();

        /** @var $EmployeeGroupArchiveRequestType EmployeeGroupArchiveRequestType */
        $EmployeeGroupArchiveRequestType = EmployeeGroupArchiveRequestType::model()->find(array(
            "condition" => "employee_group_id = :employee_group_id",
            "params" => array(
                ":employee_group_id" => $id
            )
        ));
        if ($EmployeeGroupArchiveRequestType === null) {
            $EmployeeGroupArchiveRequestType = new EmployeeGroupArchiveRequestType();
            $EmployeeGroupArchiveRequestType->employee_group_id = $EmployeeGroup->id;
        }
        $EmployeeGroupArchiveRequestType->attributes = $this->compParams($attributesArchive);
        $EmployeeGroupArchiveRequestType->save();

        return $EmployeeGroup;
    }

    /**
     * @param $id
     * @return bool true
     * @throws Exception
     */
    public function delete($id)
    {
        $EmployeeGroup = $this->loadModel($id);
        if (!$EmployeeGroup) {
            throw new \Exception('Отдел не найден');
        }

        $EmployeeGroup->delete();

        return true;
    }

    /**
     * @param $id
     * @return bool|EmployeeGroup false if not found
     */
    public function loadModel($id)
    {
        /** @var $EmployeeGroup EmployeeGroup */
        $EmployeeGroup = EmployeeGroup::model()->findByPk($id);
        if($EmployeeGroup === null) {
            return false;
        }

        return $EmployeeGroup;
    }

    /**
     * Заполнить массив недостающими параметрами
     * Примечание: в массиве $_POST нет значений для невыбранных checkboxes
     *
     * @param array $array input array
     * @return array output array
     */
    private function compParams($array)
    {
        if (!isset($array['company'])) {
            $array['company'] = 0;
        }
        if (!isset($array['wash'])) {
            $array['wash'] = 0;
        }
        if (!isset($array['tires'])) {
            $array['tires'] = 0;
        }
        if (!isset($array['service'])) {
            $array['service'] = 0;
        }

        return $array;
    }

    public function getFirstRequestType()
    {
        $EmployeeGroup = $this->loadModel($this->Employee->employee_group_id);
        if (!$EmployeeGroup) {
            throw new \Exception('Отдел не найден');
        }

        if ($EmployeeGroup->EmployeeGroupRequestType->wash) {
            return RequestWash::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupRequestType->service) {
            return RequestService::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupRequestType->tires) {
            return RequestTires::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupRequestType->company) {
            return RequestCompany::REQUEST_TYPE;
        }
    }

    public function getFirstArchiveRequestType()
    {
        $EmployeeGroup = $this->loadModel($this->Employee->employee_group_id);
        if (!$EmployeeGroup) {
            throw new \Exception('Отдел не найден');
        }

        if ($EmployeeGroup->EmployeeGroupArchiveRequestType->wash or $EmployeeGroup->manage) {
            return RequestWash::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupArchiveRequestType->service or $EmployeeGroup->manage) {
            return RequestService::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupArchiveRequestType->tires or $EmployeeGroup->manage) {
            return RequestTires::REQUEST_TYPE;
        }
        if ($EmployeeGroup->EmployeeGroupArchiveRequestType->company or $EmployeeGroup->manage) {
            return RequestCompany::REQUEST_TYPE;
        }
    }
}
