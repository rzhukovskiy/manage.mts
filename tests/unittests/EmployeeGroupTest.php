<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 24.04.2016
 * Time: 13:20
 */

/**
 * Class EmployeeGroupTest
 */
class EmployeeGroupTest extends CTestCase
{
    const EMPLOYEE_ID = 1;

    public function setUp()
    {
        EmployeeGroup::model()->deleteAll();
        EmployeeGroupRequestType::model()->deleteAll();
        EmployeeGroupArchiveRequestType::model()->deleteAll();
    }

    public function testCreate()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeGroupLib = new EmployeeGroupLib($Employee);

        $attributes['name'] = 'Название группы';
        $attributes['order_number'] = 10;
        $attributesType["wash"] = 1;
        $attributesType["service"] = 0;
        $attributesType["tires"] = 1;
        $attributesArchive["wash"] = 0;
        $attributesArchive["tires"] = 1;
        $attributesArchive["company"] = 0;

        try {
            $EmployeeGroup = $EmployeeGroupLib->create($attributes, $attributesType, $attributesArchive);

            $this->assertTrue(true);
        } catch(\Exception $e) {
            $this->assertEquals($e->getMessage(), '');
        }

        $this->assertEquals($EmployeeGroup->name, $attributes['name']);

        $this->assertEquals($EmployeeGroup->EmployeeGroupRequestType->service,  $attributesType["service"]);
        $this->assertEquals($EmployeeGroup->EmployeeGroupRequestType->tires, $attributesType["tires"]);
        $this->assertEquals($EmployeeGroup->EmployeeGroupRequestType->wash, $attributesType["wash"]);
        $this->assertEquals($EmployeeGroup->EmployeeGroupRequestType->company, 0);

        $this->assertEquals($EmployeeGroup->EmployeeGroupArchiveRequestType->service, 0);
        $this->assertEquals($EmployeeGroup->EmployeeGroupArchiveRequestType->tires, $attributesArchive["tires"]);
        $this->assertEquals($EmployeeGroup->EmployeeGroupArchiveRequestType->wash, $attributesArchive["wash"]);
        $this->assertEquals($EmployeeGroup->EmployeeGroupArchiveRequestType->company, $attributesArchive["company"]);
    }

    public function testUpdate()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);

        $attributes['name'] = 'Название группы';
        $attributes['order_number'] = 10;
        $attributes["type"]["wash"] = 1;
        $attributes["type"]["service"] = 0;
        $attributes["type"]["tires"] = 1;
        $attributes["archive"]["wash"] = 0;
        $attributes["archive"]["tires"] = 1;
        $attributes["archive"]["company"] = 0;

        $EmployeeGroupLib = new EmployeeGroupLib($Employee);

        $EmployeeGroup = $EmployeeGroupLib->create($attributes, $attributes["type"], $attributes["archive"]);

        $attributesNew['name'] = 'Название группы New';
        $attributesNew['order_number'] = 10;
        $attributesNew["type"]["wash"] = 1;
        $attributesNew["type"]["service"] = 1;
        $attributesNew["type"]["tires"] = 0;
        $attributesNew["archive"]["wash"] = 1;
        $attributesNew["archive"]["tires"] = 0;
        $attributesNew["archive"]["company"] = 0;

        try {
            $EmployeeGroupAfterUpdate = $EmployeeGroupLib->update($EmployeeGroup->id, $attributesNew, $attributesNew["type"], $attributesNew["archive"]);

            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->assertEquals($e->getMessage(), '');
        }

        $this->assertEquals($EmployeeGroupAfterUpdate->name, $attributesNew['name']);

        $this->assertEquals($EmployeeGroupAfterUpdate->RequestType->service, $attributesNew["type"]["service"]);
        $this->assertEquals($EmployeeGroupAfterUpdate->RequestType->tires, $attributesNew["type"]["tires"]);
        $this->assertEquals($EmployeeGroupAfterUpdate->RequestType->wash, $attributesNew["type"]["wash"]);
        $this->assertEquals($EmployeeGroupAfterUpdate->RequestType->company, 0);

        $this->assertEquals($EmployeeGroupAfterUpdate->ArchiveRequestType->service, 0);
        $this->assertEquals($EmployeeGroupAfterUpdate->ArchiveRequestType->tires, $attributesNew["archive"]["tires"]);
        $this->assertEquals($EmployeeGroupAfterUpdate->ArchiveRequestType->wash, $attributesNew["archive"]["wash"]);
        $this->assertEquals($EmployeeGroupAfterUpdate->ArchiveRequestType->company, $attributesNew["archive"]["company"]);
    }

    public function testDelete()
    {
        $Employee = Employee::model()->findByPk(self::EMPLOYEE_ID);
        $EmployeeGroupLib = new EmployeeGroupLib($Employee);

        $attributes['name'] = 'Название группы';
        $attributes['order_number'] = 10;
        $attributes["type"]["wash"] = 1;
        $attributes["type"]["service"] = 0;
        $attributes["type"]["tires"] = 1;
        $attributes["archive"]["wash"] = 0;
        $attributes["archive"]["tires"] = 1;
        $attributes["archive"]["company"] = 0;

        $EmployeeGroup = $EmployeeGroupLib->create($attributes, $attributes["type"], $attributes["archive"]);

        $Exists = EmployeeGroup::model()->exists(array(
            "condition" => "id = :id",
            "params" => array(
                ":id" => $EmployeeGroup->id
            )
        ));

        if (!$Exists) {
            $this->assertTrue(false);
        }

        $EmployeeGroupLib->delete($EmployeeGroup->id);

        $Exists = EmployeeGroup::model()->exists(array(
            "condition" => "id = :id",
            "params" => array(
                ":id" => $EmployeeGroup->id
            )
        ));

        if ($Exists !== false) {
            $this->assertTrue(false);
        }

        $this->assertTrue(true);
    }

}
