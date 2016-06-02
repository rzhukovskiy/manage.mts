<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 10.05.2016
 * Time: 14:46
 */

/**
 * Class RequestLib
 */
class RequestArchiveLib extends RequestLib
{
    const REQUEST_LIVE_TYPE = 'archive';

    public function getType()
    {
        return self::REQUEST_LIVE_TYPE;
    }

    /**
     * Get all requests
     *
     * @param string $group
     * @return array|RequestProcess empty array or RequestProcess
     */
    public function getRequestsCriteria($group = '')
    {
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria = $this->getGroupRequests($CDbCriteria, $group);
        $CDbCriteria->addCondition('RequestDone.id IS NOT NULL');

        return $CDbCriteria;
    }

    /**
     * Show allow request types for current employee
     *
     * @param CDbCriteria $CDbCriteria
     * @return bool|CDbCriteria false if
     */
    public function getTypes($CDbCriteria)
    {
        /** @var EmployeeGroupArchiveRequestType $EmployeeGroupArchiveRequestType */
        $EmployeeGroupArchiveRequestType = $this->EmployeeGroup->EmployeeGroupArchiveRequestType;
        if ($EmployeeGroupArchiveRequestType === null && $this->Employee->role != 'admin') {
            return false;
        }

        $CDbCriteria->with = array('RequestDone', 'RequestProcess', 'RequestCompany', 'RequestService', 'RequestTires', 'RequestWash');

        if ($this->EmployeeGroup->manage || $this->Employee->role == 'admin') {
            return $CDbCriteria;
        }

        if ($EmployeeGroupArchiveRequestType->company) {
            $CDbCriteria->addCondition('RequestCompany.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestCompany.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupArchiveRequestType->service) {
            $CDbCriteria->addCondition('RequestService.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestService.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupArchiveRequestType->tires) {
            $CDbCriteria->addCondition('RequestTires.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestTires.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupArchiveRequestType->wash) {
            $CDbCriteria->addCondition('RequestWash.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestWash.request_ptr_id IS NULL');
        }

        return $CDbCriteria;
    }

    /**
     * @param $requestId
     * @param $position
     * @param $name
     * @param $phone
     * @param $email
     * @return RequestEmployee
     * @throws
     */
    public function addEmployee($requestId, $position, $name, $phone, $email)
    {
        $RequestEmployee = new RequestEmployee();
        $RequestEmployee->request_id = $requestId;
        $RequestEmployee->position = $position;
        $RequestEmployee->name = $name;
        $RequestEmployee->phone = $phone;
        $RequestEmployee->email = $email;
        if (!$RequestEmployee->save()) {
            throw new \Exception(CHtml::errorSummary($RequestEmployee));
        }

        return $RequestEmployee;
    }

    /**
     * @param integer $id PK
     * @param string $name table key
     * @param string $value table value
     * @return bool
     * @throws Exception
     */
    public function updateEmployee($id, $name, $value)
    {
        $RequestEmployee = RequestEmployee::model()->findByPk($id);
        $RequestEmployee->$name = $value;
        if (!$RequestEmployee->save()) {
            throw new \Exception(CHtml::errorSummary($RequestEmployee));
        }

        return true;
    }

    public function removeEmployee($id)
    {
        $RequestEmployee = RequestEmployee::model()->findByPk($id);

        if (!$RequestEmployee->delete()) {
            throw new \Exception('Сотрудник не найден');
        }

        return true;
    }

    /**
     * @param $requestId
     * @param $text
     * @return RequestComments
     * @throws Exception
     */
    public function addComment($requestId, $text)
    {
        $RequestComments = new RequestComments();
        $RequestComments->request_id = $requestId;
        $RequestComments->employee_id = $this->Employee->id;
        $RequestComments->text = $text;
        if (!$RequestComments->save()) {
            throw new \Exception(CHtml::errorSummary($RequestComments));
        }

        return $RequestComments;
    }

    /**
     * @param $requestId
     * @return null|RequestComments
     */
    public function getComments($requestId)
    {
        $RequestComments = RequestComments::model()->findAll(array(
            "condition" => "request_id = :requestId",
            "params" => array(
                "requestId" => $requestId
            ),
            "order" => "id DESC"
        ));

        return $RequestComments;
    }

    public function getAllCities($group, $get = [])
    {
        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria = $this->getGroupRequests($CDbCriteria, $group);
        $CDbCriteria->addCondition('RequestDone.id IS NOT NULL');
        if (isset($get['Request'])) {
            foreach($get['Request'] as $key => $value) {
                $CDbCriteria->compare($key, $value, true);
            }
        }

        $CDbCriteria->group = 'address_city';

        $Request = Request::model()->findAll($CDbCriteria);

        return $Request;
    }

    public function getRequestsByCity($group, $city)
    {
        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria = $this->getGroupRequests($CDbCriteria, $group);
        $CDbCriteria->addCondition('RequestDone.id IS NOT NULL');

        if ($city !== '') {
            $CDbCriteria->addCondition('address_city = :city');
            $CDbCriteria->params = array('city' => $city);
        } else {
            $CDbCriteria->addCondition('address_city IS NULL');
        }

        return $CDbCriteria;
    }
}
