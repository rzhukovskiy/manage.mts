<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 15.05.2016
 * Time: 16:11
 */
class RequestEmployeesController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);
    }

    public function actionAddEmployee()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $requestId = Yii::app()->request->getQuery('requestId');

            $RequestEmployee = new RequestEmployee();
            $RequestEmployee->request_id = $requestId;
            if (!$RequestEmployee->save()) {
                $this->outJson(['result' => false, 'comment' => $RequestEmployee->getErrors()]);
            }

            $this->outJson(["result" => true]);
        }
    }

    public function actionUpdateEmployee()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $name = Yii::app()->request->getPost('name');
            $id = Yii::app()->request->getPost('pk');
            $value = Yii::app()->request->getPost('value');

            $RequestLib = new RequestLib($this->Employee);

            try {
                $RequestLib->updateEmployee($id, $name, $value);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }


            $this->outJson(['result' => true]);
        }
    }

    public function actionRemoveEmployee()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $employeeId = Yii::app()->request->getPost('employeeId');

            $RequestLib = new RequestLib($this->Employee);

            try {
                $RequestLib->removeEmployee($employeeId);
            } catch(\Exception $e) {
                $this->outJson(['result' => false, 'comment' => $e->getMessage()]);
            }


            $this->outJson(['result' => true]);
        }
    }
}
