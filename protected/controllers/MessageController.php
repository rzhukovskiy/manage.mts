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

    public function actionInbox()
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
        $CDbCriteria->addCondition("parent_id IS NULL");

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
            'inbox' => true,
        ));
    }

    public function actionOutbox()
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
        $CDbCriteria->with =['Target'];
        $CDbCriteria->compare('employee_group_id', $employeeGroupId);
        if ($this->Employee->role != 'admin') {
            $CDbCriteria->compare('`from`', $this->Employee->id);
        }
        $CDbCriteria->addCondition("parent_id IS NULL");

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
            'inbox' => false,
        ));
    }

    /**
     * Updates a particular model.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionRead($id)
    {
        $Message = Message::model()->findByPk($id);
        if ($Message && $Message->to == $this->Employee->id) {
            Message::model()->updateAll(['is_read' => 1], "parent_id = :parent_id", [":parent_id" => $id]);
            $Message->is_read = 1;
            $Message->save();
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
        $CDbCriteria->addCondition('parent_id = :id OR id = :id');
        $CDbCriteria->params = [':id' => $id];

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
            Message::model()->deleteAll('parent_id = :parent_id', [':parent_id' => $Message->id]);
            $Message->delete();
        }

        $this->redirect(Yii::app()->request->urlReferrer);
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
            if(isset($_POST['Topic'])) {
                $Topic = Message::model()->findByPk($_POST['Topic']);
                if ($Topic) {
                    $Topic->is_read = 0;
                    $Topic->save();
                    $Message->parent_id = $Topic->id;
                }
            }

            try {
                $Message->save();
            } catch(\Exception $e) {
                Yii::app()->user->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}
