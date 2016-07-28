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
    private $Employee;

    public $part = 'message';

    public function init()
    {
        $userId = Yii::app()->user->id;

        $this->Employee = Employee::model()->findByPk($userId);
    }

    public function actionList()
    {
        $EmployeeGroups = EmployeeGroup::model()->findAll(array("order" => "id"));

        if (Yii::app()->request->getQuery('id', false)) {
            $employeeGroupId = Yii::app()->request->getQuery('id');
        } else {
            $employeeGroupId = $EmployeeGroups[0]->id;
        }

        $CDbCriteria = new CDbCriteria;
        $CDbCriteria->with = ['Employee.EmployeeGroup'];
        $CDbCriteria->compare('Employee.EmployeeGroup.id', $employeeGroupId);
        $CDbCriteria->compare('is_read', 0);

        $sort = new CSort();
        $sort->defaultOrder = 'create_date DESC';

        $DataProvider = new CActiveDataProvider(Employee::model(), array(
            'criteria' => $CDbCriteria,
            'sort' => $sort
        ));

        $grid = $this->renderPartial('_grid', array(
            'DataProvider' => $DataProvider
        ), true);

        $this->render('index',array(
            'currentId' => $employeeGroupId,
            'EmployeeGroups' => $EmployeeGroups,
            'grid' => $grid
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
            $Message->create_date = time();

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
        if ($Message) {
            $Message->is_read = 1;
            $Message->save();
        }

        $this->redirect(Yii::app()->request->urlReferrer);
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
