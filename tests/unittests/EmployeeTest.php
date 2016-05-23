<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 24.04.2016
 * Time: 15:35
 */

/**
 * Class EmployeeTest
 */
class EmployeeTest extends CTestCase
{
    const EMPLOYEE_ID = 1;

    public function setUp()
    {
        Employee::model()->deleteAll();
    }

    public function testCreate()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeLib = new EmployeeLib($Employee);

        $EmployeeGroup = $this->employeeGroupCreate();

        $username = "Имя сотрудника";
        $password = "Пароль сотрудника";

        try {
            $Employee = $EmployeeLib->create($username, $password, $EmployeeGroup->id);

            $this->assertTrue(true);
        } catch(\Exception $e) {
            $this->assertEquals($e->getMessage(), '');
        }

        $this->assertEquals($Employee->username, $username);
        $this->assertTrue($Employee->validatePassword($password));
    }

    public function testUpdate()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeLib = new EmployeeLib($Employee);

        $EmployeeGroup = $this->employeeGroupCreate();

        $username = "Имя сотрудника";
        $password = "Пароль сотрудника";

        $Employee = $EmployeeLib->create($username, $password, $EmployeeGroup->id);

        $usernameNew = "Имя сотрудника Новое";
        $passwordNew = "Пароль сотрудника Измененный";

        try {
            $EmployeeAfterUpdate = $EmployeeLib->update($Employee->id, $usernameNew, $passwordNew, $EmployeeGroup->id);

            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->assertEquals($e->getMessage(), '');
        }

        $this->assertEquals($EmployeeAfterUpdate->username, $usernameNew);
        $this->assertTrue($EmployeeAfterUpdate->validatePassword($passwordNew));
    }

    public function testDelete()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeLib = new EmployeeLib($Employee);

        $EmployeeGroup = $this->employeeGroupCreate();

        $username = "Имя сотрудника";
        $password = "Пароль сотрудника";

        $Employee = $EmployeeLib->create($username, $password, $EmployeeGroup->id);

        $Exists = Employee::model()->exists(array(
            "condition" => "id = :id",
            "params" => array(
                ":id" => $Employee->id
            )
        ));

        if (!$Exists) {
            $this->assertTrue(false);
        }

        $EmployeeLib->delete($Employee->id);

        $Exists = Employee::model()->exists(array(
            "condition" => "id = :id",
            "params" => array(
                ":id" => $Employee->id
            )
        ));

        if ($Exists !== false) {
            $this->assertTrue(false);
        }

        $this->assertTrue(true);
    }

    private function employeeGroupCreate()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeGroupLib = new EmployeeGroupLib($Employee);

        $attributes['name'] = 'Название группы';
        $attributes['order_number'] = 10;

        $EmployeeGroup = $EmployeeGroupLib->create($attributes, [], []);

        return $EmployeeGroup;
    }

}
