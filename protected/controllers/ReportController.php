<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 08.04.2016
 * Time: 14:56
 */
class ReportController extends Controller
{
    public function actionRequests()
    {
        $RequestProcess=new RequestProcess('search');
        $RequestProcess->unsetAttributes();
        if(isset($_GET['RequestProcess']))
            $RequestProcess->attributes=$_GET['RequestProcess'];

        $grid = $this->renderPartial('_grid', array(
            'model' => $RequestProcess,
        ), true);

        $this->render('requests', array(
            'grid' => $grid
        ));
    }

    public function actionDates()
    {
        $RequestProcessEmployee = '';
        $dateFrom = '';
        $dateTo = '';

        if (Yii::app()->request->isPostRequest) {
            $dateFrom = Yii::app()->request->getPost('date-from');
            $dateTo = Yii::app()->request->getPost('date-to');

            $CDbCriteria = new CDbCriteria;
            $CDbCriteria->select = "COUNT(*) AS rowCount, mts_employee_group.name AS name";
            $CDbCriteria->join = 'LEFT JOIN `mts_employee` ON `mts_employee`.`id` = `t`.`employee_id`';
            $CDbCriteria->join .= 'LEFT JOIN `mts_employee_group` ON `mts_employee_group`.`id` = `mts_employee`.`employee_group_id`';
            $CDbCriteria->condition = 'finished >= :created AND finished <= :finished';
            $CDbCriteria->group = "mts_employee_group.id";
            $CDbCriteria->params = array(
                "created" => $dateFrom,
                "finished" => $dateTo
            );

            $RequestProcessEmployee = RequestProcessEmployee::model()->findAll($CDbCriteria);
        }

        $this->render('dates', array(
            "RequestProcessEmployee" => $RequestProcessEmployee,
            "dateFrom" => $dateFrom,
            "dateTo" => $dateTo
        ));
    }
}
