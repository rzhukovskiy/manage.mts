<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 10.05.2016
 * Time: 15:36
 */
class RequestActiveLib extends RequestLib
{
    const REQUEST_LIVE_TYPE = 'active';

    public function getType()
    {
        return self::REQUEST_LIVE_TYPE;
    }

    /**
     * Get all requests
     *
     * @param string $group
     * @param int $employee_id
     * @return CDbCriteria
     */
    public function getRequestsCriteria($group = '', $employee_id = 0)
    {
        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria = $this->getGroupRequests($CDbCriteria, $group);

        if($employee_id) {
            $CDbCriteria->addCondition('RequestProcessEmployee.employee_id = ' . $employee_id);
        }

        $CDbCriteria->addCondition('state = ' . Request::STATE_PROCESS . ' OR state = ' . Request::STATE_NEW);

        return $CDbCriteria;
    }

    /**
     * Move to next employee group work with request
     *
     * @param int $requestId
     * @param int $employeeGroupId Employee group who request next send
     * @return bool
     * @throws Exception
     */
    public function nextWork($requestId, $employeeGroupId)
    {
        $Request = Request::model()->findByPk($requestId);
        if ($Request == null) {
            throw new Exception("request not found");
        }
        /** @var $RequestProcessEmployee RequestProcessEmployee */
        $RequestProcessEmployee = RequestProcessEmployee::model()->find(
            "request_id = :requestId AND finished is NULL",
            array(
                "requestId" => $requestId
            )
        );
        if ($RequestProcessEmployee == null) {
            throw new Exception("request not found");
        }
        $RequestProcessEmployee->finished = date('Y-m-d H:i:s');
        if (!$RequestProcessEmployee->save()) {
            throw new Exception(CHtml::errorSummary($RequestProcessEmployee));
        }

        $updated = $RequestProcessEmployee->created;

        $Request->employee_group_id = $employeeGroupId;
        $Request->save();

        /** @var $RequestProcessEmployee RequestProcessEmployee */
        $RequestProcessEmployee = new RequestProcessEmployee();
        $RequestProcessEmployee->employee_id = $this->Employee->id;
        $RequestProcessEmployee->request_id = $requestId;
        $RequestProcessEmployee->created = $updated;
        if (!$RequestProcessEmployee->save()) {
            throw new Exception(CHtml::errorSummary($RequestProcessEmployee));
        }

        return true;
    }

    /**
     * Mark request as done
     *
     * @param $requestId
     * @return bool true
     * @throws Exception
     */
    public function finishWork($requestId)
    {
        $Request = Request::model()->findByPk($requestId);
        if ($Request) {
            $Request->state = Request::STATE_DONE;

            if (!$Request->save()) {
                throw new Exception(CHtml::errorSummary($Request));
            }
        }

        return true;
    }

    /**
     * Mark request as refused
     *
     * @param $requestId
     * @return bool true
     * @throws Exception
     */
    public function refuseWork($requestId)
    {
        $Request = Request::model()->findByPk($requestId);
        if ($Request) {
            $Request->state = Request::STATE_REFUSED;

            if (!$Request->save()) {
                throw new Exception(CHtml::errorSummary($Request));
            }
        }

        return true;
    }

    /**
     * Show allow request types for current employee
     *
     * @param CDbCriteria $CDbCriteria
     * @return bool|CDbCriteria false if
     */
    public function getTypes($CDbCriteria)
    {
        if (!isset($this->EmployeeGroup)) {
            return false;
        }

        /** @var EmployeeGroupRequestType $EmployeeGroupRequestType */
        $EmployeeGroupRequestType = $this->EmployeeGroup->EmployeeGroupRequestType;
        if ($EmployeeGroupRequestType === null && $this->Employee->role != 'admin') {
            return false;
        }

        $CDbCriteria->with = array('RequestProcessEmployee', 'RequestCompany', 'RequestService', 'RequestTires', 'RequestWash');

        if ($this->EmployeeGroup->manage || $this->Employee->role == 'admin') {
            return $CDbCriteria;
        }

        if ($EmployeeGroupRequestType->company) {
            $CDbCriteria->addCondition('RequestCompany.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestCompany.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupRequestType->service) {
            $CDbCriteria->addCondition('RequestService.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestService.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupRequestType->tires) {
            $CDbCriteria->addCondition('RequestTires.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestTires.request_ptr_id IS NULL');
        }
        if ($EmployeeGroupRequestType->wash) {
            $CDbCriteria->addCondition('RequestWash.request_ptr_id IS NOT NULL', 'OR');
        } else {
            $CDbCriteria->addCondition('RequestWash.request_ptr_id IS NULL');
        }

        return $CDbCriteria;
    }

    public static function getRequestsByEmployee($employee_id)
    {
        $Employee = Employee::model()->findByPk($employee_id);
        $Self = new self($Employee);

        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;
        $CDbCriteria = $Self->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria->with = array_merge($CDbCriteria->with, array('RequestProcessEmployee'));
        $CDbCriteria->addCondition('employee_id = :employee_id');
        $CDbCriteria->params = array("employee_id" => $Employee->id);

        return $CDbCriteria;
    }
}