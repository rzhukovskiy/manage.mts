<?php

class HomeController extends Controller
{
    public function actionIndex()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('home/login'));
        } else {
            if (Yii::app()->user->role == Employee::ADMIN_ROLE) {
                $this->redirect(Yii::app()->createUrl('employee/'));
            }
            if (Yii::app()->user->role == Employee::EMPLOYEE_ROLE) {
                $this->redirect(Yii::app()->createUrl('request/'));
            }
        }
    }

    public function actionLogin()
    {
        $this->layout = '//layouts/login';
        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login()) {
                if (Yii::app()->user->role == Employee::ADMIN_ROLE) {
                    $this->redirect(Yii::app()->createUrl('employee/'));
                }
                if (Yii::app()->user->role == Employee::EMPLOYEE_ROLE) {
                    $this->redirect(Yii::app()->createUrl('request/'));
                }
            }
        }
        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();

        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            }
            else
                $this->render('error', $error);
        }
    }

    public function actionUnLogin()
    {
        /** @var Employee $Employee */
        $Employee = Employee::model()->find(array(
            "condition" => "role = 'admin'"
        ));

        $webUser = new WebUser();
        $webUser->changeUser($Employee->id, $Employee->username, array('isMaskedUser' => false));

        $this->redirect('/');
    }

    protected function performAjaxValidation($model, $id_form)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $id_form) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
