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
    private $Employee;

    /** @var array */
    private $requestGeneralParams;

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);

        $EmployeeGroup = EmployeeGroup::model()->findAll(array("order" => "id"));

        /** @var EmployeeGroupArchiveRequestType $EmployeeGroupArchiveRequestType */
        $EmployeeGroupArchiveRequestType = $this->Employee->EmployeeGroup->EmployeeGroupArchiveRequestType;

        $this->requestGeneralParams = array_merge(
            array("Employee" => $this->Employee),
            array("EmployeeGroup" => $EmployeeGroup),
            array("EmployeeGroupArchiveRequestType" => $EmployeeGroupArchiveRequestType)
        );
    }

    public function actionDrafts()
    {
        $Employee = Employee::model()->findAll();

        $this->render('drafts', array(
            "Employee" => $Employee
        ));
    }

    public function getRequestsByEmployee($employee_id)
    {
        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $CDbCriteria = RequestActiveLib::getRequestsByEmployee($employee_id);

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
