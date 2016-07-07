<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.04.2016
 * Time: 12:06
 */
class RequestController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    /** @var array */
    private $requestGeneralParams;

    public $part = 'request';

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);

        $EmployeeGroup = EmployeeGroup::model()->findAll(array("order" => "id"));
        $requestCount = RequestCount::init($this->Employee)->count();

        $requestId = Yii::app()->request->getQuery('id', false);
        if ($requestId) {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
            if ($RequestLib->getType() == 'archive') {
                $requestCount = RequestCount::init($this->Employee)->countArchive();
                $this->part = 'archive';
            }
            if ($RequestLib->getType() == 'refused') {
                $requestCount = RequestCount::init($this->Employee)->countRefused();
                $this->part = 'refused';
            }
        }

        /** @var EmployeeGroupRequestType $EmployeeGroupRequestType */
        $EmployeeGroupRequestType = $this->Employee->EmployeeGroup->EmployeeGroupRequestType;

        /** @var EmployeeGroupArchiveRequestType $EmployeeGroupArchiveRequestType */
        $EmployeeGroupArchiveRequestType = $this->Employee->EmployeeGroup->EmployeeGroupArchiveRequestType;

        $this->requestGeneralParams = array_merge(
            array("Employee" => $this->Employee),
            array("EmployeeGroup" => $EmployeeGroup),
            array("EmployeeGroupRequestType" => $EmployeeGroupRequestType),
            array("EmployeeGroupArchiveRequestType" => $EmployeeGroupArchiveRequestType),
            $requestCount
        );
    }

    public function actionIndex()
    {
        $EmployeeGroupLib = new EmployeeGroupLib($this->Employee);
        $group = $EmployeeGroupLib->getFirstRequestType();

        if (isset($_GET['group'])) {
            $group = Yii::app()->request->getQuery('group');
        }
        $translateGroup = Request::getTranslate($group);

        $sort = new CSort();
        $sort->defaultOrder = 'new DESC, next_communication_date';

        $RequestLib = new RequestActiveLib($this->Employee);
        $CDbCriteria = $RequestLib->getRequestsCriteria($group);

        if (isset($_GET['Request'])) {
            foreach($_GET['Request'] as $key => $value) {
                if ($value) {
                    $CDbCriteria->compare($key, $value, true);
                }
            }
        }

        $DataProvider = new CActiveDataProvider(Request::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort,
            'pagination' => false,
        ));

        $this->render('index', array(
            'DataProvider' => $DataProvider,
            "User" => $this->Employee,
            "group" => $group,
            "translateGroup" => $translateGroup
        ) + $this->requestGeneralParams);
    }

    public function actionAddCompany()
    {
        try {
            $Model = new RequestCompany();
            $Instance = new RequestCompanyInstance($Model);
            $requestId = $Instance->createToProcess($this->Employee);

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
            $requestId = $Instance->createToProcess($this->Employee);

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
            $requestId = $Instance->createToProcess($this->Employee);

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
            $requestId = $Instance->createToProcess($this->Employee);

            $this->redirect('/request/details?id=' . $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionNextWork()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getQuery('id');
            $employeeGroupId = Yii::app()->request->getQuery('employeeGroupId');

            try {
                $RequestActiveLib = new RequestActiveLib($this->Employee);
                $RequestActiveLib->nextWork($requestId, $employeeGroupId);
            } catch(Exception $e) {
                $this->outJson(["result" => false, "comment" => $e->getMessage()]);
            }

            $this->outJson(["result" => true]);
        }
    }

    public function actionFinishWork()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getQuery('id');

            try {
                $RequestActiveLib = new RequestActiveLib($this->Employee);
                $RequestActiveLib->finishWork($requestId);
            } catch(Exception $e) {
                $this->outJson(["result" => false, "comment" => $e->getMessage()]);
            }

            $this->outJson(["result" => true]);
        }
    }

    public function actionRefuseWork()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getQuery('id');

            try {
                $RequestActiveLib = new RequestActiveLib($this->Employee);
                $RequestActiveLib->refuseWork($requestId);
            } catch(Exception $e) {
                $this->outJson(["result" => false, "comment" => $e->getMessage()]);
            }

            $this->outJson(["result" => true]);
        }
    }


    public function actionDetails()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        if ($this->Employee->role != 'admin') {
            $Request = $RequestLib->getRequest();
        } else {
            $Request = Request::model()->findByPk($requestId);
        }

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $Model = Instance::detectType($Request->id);

        $this->render('tabs/main', array(
            'Request' => $Request,
            'RequestLib' => $RequestLib,
            'group' => $Model::REQUEST_TYPE
            ) + $this->requestGeneralParams);
    }

    public function actionInfo()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/info', array(
                'Request' => $Request,
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    public function actionEmployees()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/employees', array(
                'Request' => $Request,
                'EmployeeNew' => new RequestEmployee(),
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    public function actionComments()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        $RequestComments = $RequestLib->getComments($requestId);

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/comments', array(
                'Request' => $Request,
                'RequestComments' => $RequestComments,
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    public function actionCompanyDetails()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        $RequestComments = $RequestLib->getComments($requestId);

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/types/company', array(
                'Request' => $Request,
                'RequestComments' => $RequestComments,
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    public function actionCompanyDrivers()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        $RequestComments = $RequestLib->getComments($requestId);

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $Drivers = new RequestCompanyDriver();
        $Drivers->request_ptr_id = $requestId;
        $DataProvider = $Drivers->search();

        $this->render('tabs/types/companyDrivers', array(
                'Request' => $Request,
                'RequestComments' => $RequestComments,
                'RequestLib' => $RequestLib,
                'DataProvider' => $DataProvider
            ) + $this->requestGeneralParams);
    }

    public function actionRequestPrices()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        $RequestComments = $RequestLib->getComments($requestId);

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/types/requestPrices', array(
                'Request' => $Request,
                'RequestComments' => $RequestComments,
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    public function actionRequestDetails()
    {
        $requestId = Yii::app()->request->getQuery('id');

        try {
            $RequestLib = RequestLib::setRequest($this->Employee, $requestId);
        } catch(\Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());

            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $Request = $RequestLib->getRequest();

        $RequestComments = $RequestLib->getComments($requestId);

        if ($Request === false) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('tabs/types/requestDetails', array(
                'Request' => $Request,
                'RequestComments' => $RequestComments,
                'RequestLib' => $RequestLib
            ) + $this->requestGeneralParams);
    }

    //---

    public function actionUpdateDetails($id = 0)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $name = Yii::app()->request->getPost('name');
            $id = Yii::app()->request->getPost('pk');
            $value = Yii::app()->request->getPost('value');

            try {
                $Instance = Instance::init($id);
                $Instance->updateAjax($id, $name, $value);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }

            $this->outJson(['result' => true]);
        }

        if (Yii::app()->request->isPostRequest) {
            try {
                $Instance = Instance::init($id);
                $Instance->update($_POST);
            } catch(\Exception $e) {
                Yii::app()->user->setFlash('error', $e->getMessage());
            }

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionSaveAgreement()
    {
        $requestId = Yii::app()->request->getPost('requestId');

        try {
            $filename = RequestFile::fileUpload($requestId);
        } catch(\Exception $e) {
            $this->outJson(["result" => false, "comment" => $e->getMessage()]);
        }

        $Instance = Instance::init($requestId);

        try {
            $Instance->updateAgreementFile($filename);
        } catch(\Exception $e) {
            $this->outJson(["result" => false, "comment" => $e->getMessage()]);
        }

        $this->outJson(["result" => true]);
    }

    public function actionGetAgreement()
    {
        $requestId = Yii::app()->request->getQuery('id');
        $Instance = Instance::init($requestId);

        try {
            $filename = $Instance->getAgreementFile();
        } catch(\Exception $e) {
            $this->outJson(["result" => false, "comment" => $e->getMessage()]);
        }

        try {
            RequestFile::streaming($requestId, $filename);
        } catch(\Exception $e) {
            $this->outJson(["result" => false, "comment" => $e->getMessage()]);
        }
    }

    public function actionSendMail()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $plainTextContent = Yii::app()->request->getPost('text');
            $subject = Yii::app()->request->getPost('subject');
            $toEmail = Yii::app()->request->getPost('email');
            $toName = Yii::app()->request->getPost('name');

            /** @var SwiftMailer $SwiftMailer */
            $headers  = 'From: info@mtransservice.ru' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "To: $toName <$toEmail>" . "\r\n";

            $res = mail($toEmail, $subject, $plainTextContent, $headers);

            $this->outJson(['result' => $res]);
        }
    }
}
