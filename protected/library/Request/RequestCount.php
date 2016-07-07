<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 05.04.2016
 * Time: 22:17
 */

class RequestCount
{
    /** @var $Employee Employee */
    private $Employee;

    /** @var $EmployeeGroup EmployeeGroup */
    private $EmployeeGroup;

    public function __construct($Employee)
    {
        $this->Employee = $Employee;

        /** @var $EmployeeGroup EmployeeGroup */
        $this->EmployeeGroup = $this->Employee->EmployeeGroup;
    }

    public static function init($Employee)
    {
        return new self($Employee);
    }

    public function count()
    {
        $CDbCriteria = new CDbCriteria;

        $RequestLib = new RequestActiveLib($this->Employee);
        $CDbCriteria = $RequestLib->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return false;
        }

        $arrayEmployeeGroups = array($this->EmployeeGroup->id);
        $CDbCriteria->addCondition('RequestRefused.id IS NULL AND RequestDone.id IS NULL AND (RequestProcess.id IS NULL OR RequestProcess.employee_group_id IN (' . implode(",", $arrayEmployeeGroups) . '))');

        return [
            "countAll" => $this->getAll($CDbCriteria),
            "countCompany" => $this->getCompany($CDbCriteria),
            "countWash" => $this->getWash($CDbCriteria),
            "countTires" => $this->getTires($CDbCriteria),
            "countService" => $this->getService($CDbCriteria)
        ];
    }

    public function countArchive()
    {
        $CDbCriteria = new CDbCriteria;

        $RequestLib = new RequestActiveLib($this->Employee);
        $CDbCriteria = $RequestLib->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return false;
        }

        $arrayEmployeeGroups = array($this->EmployeeGroup->id);
        if ($this->Employee->role == 'admin') {
            $CDbCriteria = new CDbCriteria();
            $CDbCriteria->with = array('RequestProcess', 'RequestDone', 'RequestCompany', 'RequestService', 'RequestTires', 'RequestWash');
            $CDbCriteria->addCondition('RequestDone.id IS NOT NULL');
        } else {
            $CDbCriteria->addCondition('RequestDone.id IS NOT NULL AND (RequestProcess.id IS NULL OR RequestProcess.employee_group_id IN (' . implode(",", $arrayEmployeeGroups) . '))');
        }

        return [
            "countAll" => $this->getAll($CDbCriteria),
            "countCompany" => $this->getCompany($CDbCriteria),
            "countWash" => $this->getWash($CDbCriteria),
            "countTires" => $this->getTires($CDbCriteria),
            "countService" => $this->getService($CDbCriteria)
        ];
    }

    public function countRefused()
    {
        $CDbCriteria = new CDbCriteria;

        $RequestLib = new RequestActiveLib($this->Employee);
        $CDbCriteria = $RequestLib->getTypes($CDbCriteria);
        if (!$CDbCriteria) {
            return false;
        }

        $arrayEmployeeGroups = array($this->EmployeeGroup->id);
        if ($this->Employee->role == 'admin') {
            $CDbCriteria = new CDbCriteria();
            $CDbCriteria->with = array('RequestProcess', 'RequestRefused', 'RequestDone', 'RequestCompany', 'RequestService', 'RequestTires', 'RequestWash');
            $CDbCriteria->addCondition('RequestRefused.id IS NOT NULL');
        } else {
            $CDbCriteria->addCondition('RequestRefused.id IS NOT NULL AND (RequestProcess.id IS NULL OR RequestProcess.employee_group_id IN (' . implode(",", $arrayEmployeeGroups) . '))');
        }

        return [
            "countAll" => $this->getAll($CDbCriteria),
            "countCompany" => $this->getCompany($CDbCriteria),
            "countWash" => $this->getWash($CDbCriteria),
            "countTires" => $this->getTires($CDbCriteria),
            "countService" => $this->getService($CDbCriteria)
        ];
    }

    private function getAll($CDbCriteria)
    {
        $countRequestProcess = Request::model()->count($CDbCriteria);

        return $countRequestProcess;
    }

    private function getCompany($CDbCriteria)
    {
        $CDbCriteria->join = 'RIGHT JOIN `mts_request_company` ON `mts_request_company`.`request_ptr_id` = `t`.`id`';
        $countRequestProcess = Request::model()->count($CDbCriteria);

        return $countRequestProcess;
    }

    private function getWash($CDbCriteria)
    {
        $CDbCriteria->join = 'RIGHT JOIN `mts_request_wash` ON `mts_request_wash`.`request_ptr_id` = `t`.`id`';
        $countRequestProcess = Request::model()->count($CDbCriteria);

        return $countRequestProcess;
    }

    private function getService($CDbCriteria)
    {
        $CDbCriteria->join = 'RIGHT JOIN `mts_request_service` ON `mts_request_service`.`request_ptr_id` = `t`.`id`';
        $countRequestProcess = Request::model()->count($CDbCriteria);

        return $countRequestProcess;
    }

    private function getTires($CDbCriteria)
    {
        $CDbCriteria->join = 'RIGHT JOIN `mts_request_tires` ON `mts_request_tires`.`request_ptr_id` = `t`.`id`';
        $countRequestProcess = Request::model()->count($CDbCriteria);

        return $countRequestProcess;
    }
}
