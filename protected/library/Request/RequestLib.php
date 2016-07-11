<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 05.04.2016
 * Time: 21:09
 */

/**
 * Class RequestLib
 */
class RequestLib
{
    /** @var int */
    protected $id;

    /** @var $Employee Employee */
    protected $Employee;

    /** @var $EmployeeGroup EmployeeGroup */
    protected $EmployeeGroup;

    public function __construct($Employee)
    {
        $this->Employee = $Employee;

        /** @var $EmployeeGroup EmployeeGroup */
        $this->EmployeeGroup = $this->Employee->EmployeeGroup;
    }

    public function setRequestId($id)
    {
        $this->id = $id;
    }

    public function getAllGroups()
    {
        return [
            'wash',
            'service',
            'tires',
            'company',
        ];
    }

    /**
     * @param $id
     * @return bool|CDbCriteria false if not found
     */
    protected function getRequestCDbCriteria($id)
    {
        /** @var Request $Request */
        $Request = Request::model()->findByPk($id);
        if ($Request->new) {
            $Request->new = 0;
            $Request->save();
        }

        /** @var CDbCriteria $CDbCriteria */
        $CDbCriteria = new CDbCriteria;

        $CDbCriteria = $this->getTypes($CDbCriteria);

        if (!$CDbCriteria) {
            return false;
        }

        $CDbCriteria->addCondition("t.id = :requestId");
        $CDbCriteria->params = array("requestId" => $id);

        return $CDbCriteria;
    }

    /**
     * Select request only current group
     *
     * @param $CDbCriteria
     * @param $group
     * @return CDbCriteria
     */
    protected function getGroupRequests($CDbCriteria, $group)
    {
        switch($group) {
            case "company":
                $CDbCriteria->join = 'RIGHT JOIN `mts_request_company` ON `mts_request_company`.`request_ptr_id` = `t`.`id`';

                break;

            case "wash":
                $CDbCriteria->join = 'RIGHT JOIN `mts_request_wash` ON `mts_request_wash`.`request_ptr_id` = `t`.`id`';

                break;

            case "service":
                $CDbCriteria->join = 'RIGHT JOIN `mts_request_service` ON `mts_request_service`.`request_ptr_id` = `t`.`id`';

                break;

            case "tires":
                $CDbCriteria->join = 'RIGHT JOIN `mts_request_tires` ON `mts_request_tires`.`request_ptr_id` = `t`.`id`';

                break;
        }

        return $CDbCriteria;
    }

    public static function setRequest($Employee, $requestId)
    {
        $Request = Request::model()->findByPk($requestId);
        $RequestLib = null;
        if ($Request !== null) {
            switch($Request->state) {
                case Request::STATE_DONE:
                    $RequestLib = new RequestArchiveLib($Employee);
                    break;

                case Request::STATE_REFUSED:
                    $RequestLib = new RequestRefusedLib($Employee);
                    break;

                default:
                    $RequestLib = new RequestActiveLib($Employee);
            }
        }

        $RequestLib->setRequestId($requestId);

        return $RequestLib;
    }

    /**
     * @return bool|Request false if not found
     */
    public function getRequest()
    {
        $CDbCriteria = $this->getRequestCDbCriteria($this->id);

        /** @var $Request Request */
        $Request = Request::model()->find($CDbCriteria);

        if ($Request === null) {
            return false;
        }

        return $Request;
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
}
