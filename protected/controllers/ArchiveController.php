<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 14.05.2016
 * Time: 8:31
 */
class ArchiveController extends Controller
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

        $EmployeeGroupArchiveRequestType = [];
        if (isset($this->Employee->EmployeeGroup)) {
            /** @var EmployeeGroupArchiveRequestType $EmployeeGroupArchiveRequestType */
            $EmployeeGroupArchiveRequestType = $this->Employee->EmployeeGroup->EmployeeGroupArchiveRequestType;
        }

        $this->requestGeneralParams = array_merge(
            array("Employee" => $this->Employee),
            array("EmployeeGroup" => $EmployeeGroup),
            array("EmployeeGroupArchiveRequestType" => $EmployeeGroupArchiveRequestType)
        );
    }

    public function actionList()
    {
        try {
            $EmployeeGroupLib = new EmployeeGroupLib($this->Employee);
            $group = $EmployeeGroupLib->getFirstArchiveRequestType();
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }

        if (isset($_GET['group'])) {
            $group = Yii::app()->request->getQuery('group');
        }

        $sort = new CSort();
        $sort->defaultOrder = 't.id DESC';

        $RequestArchiveLib = new RequestArchiveLib($this->Employee);
        $Cities = $RequestArchiveLib->getAllCities($group);

        $this->render('list', array(
                "group" => $group,
                'Cities' => $Cities
            ) + $this->requestGeneralParams);
    }

    public function getRequestsByCity($group, $city)
    {
        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $RequestArchiveLib = new RequestArchiveLib($this->Employee);
        $CDbCriteria = $RequestArchiveLib->getRequestsByCity($group, $city);

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort
        ));

        $grid = $this->renderPartial('_gridArchive', array(
            'DataProvider' => $DataProvider
        ), true);

        return $grid;
    }


    public function actionAddCompany()
    {
        try {
            $Model = new RequestCompany();
            $Instance = new RequestCompanyInstance($Model);
            $requestId = $Instance->createToArchive();

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionAddWash()
    {
        try {
            $Model = new RequestWash();
            $Instance = new RequestWashInstance($Model);
            $requestId = $Instance->createToArchive();

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionAddTires()
    {
        try {
            $Model = new RequestTires();
            $Instance = new RequestTiresInstance($Model);
            $requestId = $Instance->createToArchive();

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionAddService()
    {
        try {
            $Model = new RequestService();
            $Instance = new RequestServiceInstance($Model);
            $requestId = $Instance->createToArchive();

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
}
