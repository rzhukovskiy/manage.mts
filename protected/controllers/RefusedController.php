<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 14.05.2016
 * Time: 8:31
 */
class RefusedController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    /** @var array */
    private $requestGeneralParams;

    public $part = 'refused';

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

        $RequestRefusedLib = new RequestRefusedLib($this->Employee);
        $Cities = $RequestRefusedLib->getAllCities($group, $_GET);

        $requestCount = RequestCount::init($this->Employee)->countRefused();

        $translateGroup = Request::getTranslate($group);
        $this->render('list', array(
                "group" => $group,
                "translateGroup" => $translateGroup,
                'Cities' => $Cities
            ) + $this->requestGeneralParams + $requestCount);
    }

    public function getRequestsByCity($group, $city)
    {
        $sort = new CSort();
        $sort->defaultOrder = 'next_communication_date';

        $RequestRefusedLib = new RequestRefusedLib($this->Employee);
        $CDbCriteria = $RequestRefusedLib->getRequestsByCity($group, $city);

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort
        ));

        if (isset($_GET['Request'])) {
            foreach($_GET['Request'] as $key => $value) {
                if ($value) {
                    $CDbCriteria->compare($key, $value, true);
                }
            }
        }

        $grid = $this->renderPartial('_gridArchive', array(
            'DataProvider' => $DataProvider,
        ), true);

        return $grid;
    }

    public function getSearchForm()
    {
        $CDbCriteria = new CDbCriteria();
        $CDbCriteria->compare('id', 0);

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
        ));

        $grid = $this->renderPartial('_filterArchive', array(
            'DataProvider' => $DataProvider,
        ), true);

        return $grid;
    }

    public function actionAddCompany()
    {
        try {
            $Model = new RequestCompany();
            $Instance = new RequestCompanyInstance($Model);
            $requestId = $Instance->createToRefused();

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
            $requestId = $Instance->createToRefused();

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
            $requestId = $Instance->createToRefused();

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
            $requestId = $Instance->createToRefused();

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
}
