<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 09.05.2016
 * Time: 15:39
 */
class AdminController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    public $part = 'drafts';

    /** @var array */
    private $requestGeneralParams;

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);

        $EmployeeGroup = EmployeeGroup::model()->findAll(array("order" => "id"));

        $this->requestGeneralParams = array_merge(
            array("Employee" => $this->Employee),
            array("EmployeeGroup" => $EmployeeGroup)
        );
    }

    public function actionDrafts()
    {
        $Employee = Employee::model()->findAll();
        $this->part = 'drafts';

        $employeeId = Yii::app()->request->getQuery('employee', false);
        if (!$employeeId) {
            foreach($Employee as $CurrentEmployee) {
                if ($this->getRequestsCountByEmployee($CurrentEmployee->id)) {
                    $employeeId = $CurrentEmployee->id;
                    break;
                }
            }
        }
        $EmployeeGroupLib = new EmployeeGroupLib(Employee::model()->findByPk($employeeId));
        $group = $EmployeeGroupLib->getFirstRequestType();
        if (isset($_GET['group'])) {
            $group = Yii::app()->request->getQuery('group');
        }

        $RequestLib = new RequestLib($this->Employee);
        $Groups = $RequestLib->getAllGroups();

        $this->render('drafts', array(
            "Employee" => $Employee,
            "employeeId" => $employeeId,
            "Groups" => $Groups,
            "group" => $group,
        ));
    }

    public function getRequestsByEmployee($employee_id)
    {
        $Employee = Employee::model()->findByPk($employee_id);
        $RequestLib = new RequestActiveLib($Employee);
        $CDbCriteria = $RequestLib->getRequestsCriteria();

        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort,
            'pagination' => false,
        ));

        $grid = $this->renderPartial('_gridDraft', array(
            'DataProvider' => $DataProvider
        ), true);

        return $grid;
    }

    public function getRequestsByEmployeeAndGroup($employee_id, $group)
    {
        $Employee = Employee::model()->findByPk($employee_id);
        $RequestLib = new RequestActiveLib($Employee);
        $CDbCriteria = $RequestLib->getRequestsCriteria($group, $employee_id);

        if (isset($_GET['Request'])) {
            foreach($_GET['Request'] as $key => $value) {
                $CDbCriteria->compare($key, $value, true);
            }
        }

        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort,
            'pagination' => false,
        ));

        $grid = $this->renderPartial('_gridDraft', array(
            'DataProvider' => $DataProvider
        ), true);

        return $grid;
    }

    public function getRequestsCountByEmployee($employee_id)
    {
        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $CDbCriteria = RequestActiveLib::getRequestsByEmployee($employee_id);

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort,
            'pagination' => false,
        ));

        return $DataProvider->getData();
    }

    public function getRequestsCountByEmployeeAndGroup($employee_id, $group)
    {
        $Employee = Employee::model()->findByPk($employee_id);
        $RequestLib = new RequestActiveLib($Employee);
        $CDbCriteria = $RequestLib->getRequestsCriteria($group, $employee_id);

        if (isset($_GET['Request'])) {
            foreach($_GET['Request'] as $key => $value) {
                $CDbCriteria->compare($key, $value, true);
            }
        }

        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort,
            'pagination' => false,
        ));

        return count($DataProvider->getData());
    }

    public function actionDeleteFromArchive()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $Instance = Instance::init($requestId);
            $Instance->deleteFromArchive();
        } catch(\Exception $e) {
            $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
        }

        $this->outJson(['result' => true]);
    }
}
