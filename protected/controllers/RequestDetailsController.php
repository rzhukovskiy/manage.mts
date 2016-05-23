<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 15.05.2016
 * Time: 16:01
 */
class RequestDetailsController extends Controller
{
    public function actionUpdateWashPrices($id = 0)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $Instance = Instance::init($id);
                $Instance->updateWashPrices($_POST);
            } catch(\Exception $e) {
                Yii::app()->user->setFlash('error', $e->getMessage());
            }

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionUpdateCompanyDrivers($id = 0)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $Instance = Instance::init($id);
                $Instance->updateCompanyDrivers($_POST);
            } catch(\Exception $e) {
                Yii::app()->user->setFlash('error', $e->getMessage());
            }

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }


    //------------

    public function actionAddCompanyAdvancedDetail()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('company', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddCompanyListAuto()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('companyListAuto', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddCompanyDriver()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('companyDriver', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddWashAdvancedDetail()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('wash', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddServiceWorkRate()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('serviceWorkRate', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddServiceServeOrganisation()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('serviceServeOrganisation', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddTiresAdvancedDetail()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('tires', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }

    public function actionAddWashService()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $advancedDetails = $this->renderPartial('washService', array(), true);

            $this->outJson(["result" => true, "html" => $advancedDetails]);
        }
    }


    //-------

    public function actionUpdateServiceDealer()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $name = Yii::app()->request->getPost('name');
            $id = Yii::app()->request->getPost('pk');
            $value = Yii::app()->request->getPost('value');

            try {
                $Instance = Instance::init($id);
                $Instance->updateServiceDealer($name, $value);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }


            $this->outJson(['result' => true]);
        }
    }

    public function actionUpdateCompanyContact()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $name = Yii::app()->request->getPost('name');
            $id = Yii::app()->request->getPost('pk');
            $value = Yii::app()->request->getPost('value');

            try {
                $Instance = Instance::init($id);
                $Instance->updateCompanyContact($name, $value);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }


            $this->outJson(['result' => true]);
        }
    }

    public function actionAddCompanyListAutoFromExcelFile()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getPost('requestId');

            try {
                Excel::companyListAutoFromExcelFile($requestId, $_FILES);
            } catch(\Exception $e) {
                $this->outJson(["result" => false, "comment" => $e->getMessage()]);
            }

            $this->outJson(["result" => true]);
        }
    }

    public function actionAddCompanyDriverFromExcelFile()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getPost('requestId');

            try {
                Excel::companyDriverFromExcelFile($requestId, $_FILES);
            } catch(\Exception $e) {
                $this->outJson(["result" => false, "comment" => $e->getMessage()]);
            }

            $this->outJson(["result" => true]);
        }
    }
}
