<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 24.04.2016
 * Time: 15:36
 */

/**
 * Class Employee
 */
class EmployeeLib
{
    /** @var Employee */
    private $Employee;

    public function __construct($Employee)
    {
        $this->Employee = $Employee;
    }

    /**
     * @param $username
     * @param $password
     * @param $employeeGroupId
     * @return Employee
     * @throws Exception
     */
    public function create($username, $password, $employeeGroupId)
    {
        $Employee = new Employee;

        $Employee->employee_group_id = $employeeGroupId;
        $Employee->username = $username;

        $PasswordLib = new Password($password);
        $PasswordLib->beforeSave();
        $Employee->password = $PasswordLib->getPassword();
        $Employee->salt = $PasswordLib->getSalt();
        if(!$Employee->save()) {
            throw new \Exception(CHtml::errorSummary($Employee));
        }

        return $Employee;
    }

    /**
     * @param $id
     * @param $username
     * @param $password
     * @param $employeeGroupId
     * @return Employee
     * @throws Exception
     */
    public function update($id, $username, $password, $employeeGroupId)
    {
        $Employee = $this->loadModel($id);
        if (!$Employee) {
            throw new \Exception('Сотрудник не найден');
        }

        $oldPassword = $Employee->password;

        //Если пароль не изменился
        if ($oldPassword == $password) {
            $Employee->employee_group_id = $employeeGroupId;
            $Employee->username = $username;
        } else {
            $Employee->employee_group_id = $employeeGroupId;
            $Employee->username = $username;

            $PasswordLib = new Password($password);
            $PasswordLib->beforeSave();
            $Employee->password = $PasswordLib->getPassword();
            $Employee->salt = $PasswordLib->getSalt();
        }

        if(!$Employee->save()) {
            throw new \Exception(CHtml::errorSummary($Employee));
        }

        return $Employee;
    }

    /**
     * @param $id
     * @return bool true
     * @throws Exception
     */
    public function delete($id)
    {
        $Employee = $this->loadModel($id);
        if (!$Employee) {
            throw new \Exception('Отдел не найден');
        }

        $Employee->delete();

        return true;
    }

    /**
     * @param $id
     * @return bool|Employee false if not found
     */
    public function loadModel($id)
    {
        /** @var $Employee Employee */
        $Employee = Employee::model()->findByPk($id);
        if($Employee === null) {
            return false;
        }

        return $Employee;
    }

    /**
     * @param int $employeeGroupId
     * @return Employee|null
     */
    public function getEmployeesFromGroup($type)
    {
        $CDbCriteria = new CDbCriteria;
        $CDbCriteria->join = 'LEFT JOIN `mts_employee_group_request_type` ON `mts_employee_group_request_type`.`employee_group_id` = `t`.`employee_group_id`';
        $CDbCriteria->params = array(`mts_employee_group_request_type`.$type => 1);

        $Employee = Employee::model()->findAll($CDbCriteria);

        return $Employee;
    }
}
