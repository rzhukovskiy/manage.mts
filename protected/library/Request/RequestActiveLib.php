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
     * @return CDbCriteria
     */
    public function getRequestsCriteria($group = '')
    {
        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return [];
        }

        $CDbCriteria = $this->getGroupRequests($CDbCriteria, $group);

        $arrayEmployeeGroups = array($this->EmployeeGroup->id);
        $CDbCriteria->addCondition('RequestDone.id IS NULL AND (RequestProcess.id IS NULL OR RequestProcess.employee_group_id IN (' . implode(",", $arrayEmployeeGroups) . '))');

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
        /** @var $RequestProcess RequestProcess */
        $RequestProcess = RequestProcess::model()->find(
            "request_id = :requestId",
            array(
                //"employee_group_id" => $this->EmployeeGroup->id,
                "requestId" => $requestId
            )
        );
        if ($RequestProcess == null) {
            throw new Exception("request not found");
        }

        $updated = $RequestProcess->updated;

        $RequestProcess->employee_group_id = $employeeGroupId;
        $RequestProcess->save();

        /** @var $RequestProcessEmployee RequestProcessEmployee */
        $RequestProcessEmployee = new RequestProcessEmployee();
        $RequestProcessEmployee->employee_id = $this->Employee->id;
        $RequestProcessEmployee->request_process_id = $requestId;
        $RequestProcessEmployee->created = $updated;
        $RequestProcessEmployee->finished = date('Y-m-d H:i:s');
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
        /** @var $RequestProcess RequestProcess */
        $RequestProcess = RequestProcess::model()->find(
            "request_id = :requestId",
            array(
                //"employee_group_id" => $this->EmployeeGroup->id,
                "requestId" => $requestId
            )
        );
        if ($RequestProcess == null) {
            throw new Exception("request not found");
        }

        $RequestProcess->delete();

        $RequestDone = new RequestDone();
        $RequestDone->request_id = $requestId;
        if (!$RequestDone->save()) {
            throw new Exception(CHtml::errorSummary($RequestDone));
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
        if ($EmployeeGroupRequestType === null) {
            return false;
        }

        $CDbCriteria->with = array('RequestProcess', 'RequestDone', 'RequestCompany', 'RequestService', 'RequestTires', 'RequestWash');

        if ($this->EmployeeGroup->manage) {
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

        $CDbCriteria->with = array_merge($CDbCriteria->with, array('RequestProcess.RequestProcessEmployee'));
        $CDbCriteria->addCondition('employee_id = :employee_id');
        $CDbCriteria->params = array("employee_id" => $Employee->id);

        return $CDbCriteria;
    }
}