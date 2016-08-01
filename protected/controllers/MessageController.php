<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 14.05.2016
 * Time: 8:31
 */
class MessageController extends Controller
{
    /** @var $Employee Employee */
    public $Employee;

    public $part = 'message';

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);
    }

    public function actionList()
    {
        $EmployeeGroups = EmployeeGroup::model()->findAll('id != ' . $this->Employee->employee_group_id);
        if (Yii::app()->request->getQuery('id', false)) {
            $employeeGroupId = Yii::app()->request->getQuery('id');
        } else {
            $employeeGroupId = $EmployeeGroups[0]->id;
        }

        $Employees = Employee::model()->findAll([
            "condition" => "employee_group_id = :employee_group_id",
            "order" => "id",
            "params" => [
                ':employee_group_id' => $employeeGroupId,
            ]
        ]);

        $CDbCriteria = new CDbCriteria;
        $CDbCriteria->with =['Author'];
        $CDbCriteria->compare('employee_group_id', $employeeGroupId);
        if ($this->Employee->role != 'admin') {
            $CDbCriteria->compare('`to`', $this->Employee->id);
        }
        $CDbCriteria->addCondition("t.create_date IN (SELECT MAX(create_date) as create_date FROM " . Message::model()->tableName() . " GROUP BY `from`, `to`)");

        $sort = new CSort();

        $DataProvider = new CActiveDataProvider(Message::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort
        ));

        $grid = $this->renderPartial('_list', array(
            'DataProvider' => $DataProvider,
            'buttons' => true,
        ), true);

        $this->render('list',array(
            'currentId' => $employeeGroupId,
            'EmployeeGroups' => $EmployeeGroups,
            'Employees' => $Employees,
            'grid' => $grid,
        ));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate()
    {
        if(isset($_POST['Message'])) {
            $Message = new Message();
            $Message->attributes = $_POST['Message'];
            $Message->from = $this->Employee->id;

            try {
                $Message->save();
            } catch(\Exception $e) {
                Yii::app()->user->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * Updates a particular model.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $Message = Message::model()->findByPk($id);
        if ($Message && $Message->to == $this->Employee->id) {
            Message::model()->updateAll(['is_read' => 1], "`from` = $Message->from AND `to` = $Message->to");
        }

        $EmployeeGroups = EmployeeGroup::model()->findAll(["order" => "id"]);
        $employeeGroupId = $Message->Author->employee_group_id;

        $Employees = Employee::model()->findAll([
            "condition" => "employee_group_id = :employee_group_id",
            "order" => "id",
            "params" => [
                ':employee_group_id' => $employeeGroupId,
            ]
        ]);

        $CDbCriteria = new CDbCriteria;
        $CDbCriteria->addCondition("(`to` = {$this->Employee->id} AND `from` = {$Message->from}) OR (`from` = {$this->Employee->id} AND `to` = {$Message->from})");

        $sort = new CSort();
        $sort->defaultOrder = 't.create_date DESC';

        $DataProvider = new CActiveDataProvider(Message::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort
        ));

        $grid = $this->renderPartial('_conversation', array(
            'DataProvider' => $DataProvider,
            'buttons' => false,
        ), true);

        $this->render('update',array(
            'currentId' => $employeeGroupId,
            'EmployeeGroups' => $EmployeeGroups,
            'Employees' => $Employees,
            'Message' => $Message,
            'grid' => $grid,
        ));
    }

    /**
     * Deletes a particular model.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $Message = Message::model()->findByPk($id);
        if ($Message) {
            $Message->delete();
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}
