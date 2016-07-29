<?php

class EmployeeController extends Controller
{
	/** @var $Employee Employee */
	public $Employee;

	public $part = 'employee';

	public function init()
	{
		$userId = Yii::app()->user->id;

		$this->Employee = Employee::model()->findByPk($userId);
	}


	/**
	 * Main action
	 *
	 * Hardcode: "&supermode" - show admin
	 */
	public function actionIndex()
	{
		$EmployeeGroups = EmployeeGroup::model()->findAll(array("order" => "id"));

		if (Yii::app()->request->getQuery('id', false)) {
			$employeeGroupId = Yii::app()->request->getQuery('id');
		} else {
			$employeeGroupId = $EmployeeGroups[0]->id;
		}

		$CDbCriteria = new CDbCriteria;
		$CDbCriteria->compare('employee_group_id', $employeeGroupId);

		//
		if (!isset($_GET["supermode"])) {
			$CDbCriteria->addCondition('role != "admin"');
		}

		$sort = new CSort();
		$sort->defaultOrder = 'username';

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
		$EmployeeLib = new EmployeeLib($this->Employee);

		if(!isset($_POST['Employee'])) {
			$this->redirect(Yii::app()->request->urlReferrer);
		}

		$password = $_POST['Employee']['password'];
		$employeeGroupId = $_POST['Employee']['employee_group_id'];
		$username = $_POST['Employee']['username'];

		try {
			$EmployeeLib->create($username, $password, $employeeGroupId);
		} catch(\Exception $e) {
			Yii::app()->user->setFlash('error', $e->getMessage());
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
		$EmployeeLib = new EmployeeLib($this->Employee);

		if(isset($_POST['Employee']))
		{
			$password = $_POST['Employee']['password'];
			$employeeGroupId = $_POST['Employee']['employee_group_id'];
			$username = $_POST['Employee']['username'];

			try {
				$EmployeeLib->update($id, $username, $password, $employeeGroupId);

				$urlReferrer = Yii::app()->request->getPost('urlReferrer');
				$this->redirect($urlReferrer);
			} catch (\Exception $e) {
				Yii::app()->user->setFlash('error', $e->getMessage());
			}
		}

		$EmployeeGroup = EmployeeGroup::model()->findAll(array("order" => "id"));

		$this->render('update',array(
			'model' => $EmployeeLib->loadModel($id),
			'EmployeeGroup' => $EmployeeGroup,
			'urlReferrer' => Yii::app()->request->urlReferrer
		));
	}

	/**
	 * Deletes a particular model.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$EmployeeLib = new EmployeeLib($this->Employee);

		$EmployeeLib->delete($id);

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionLogin()
	{
		$id = Yii::app()->request->getQuery('id');

		/** @var Employee $Employee */
		$Employee = Employee::model()->findByPk($id);

		$webUser = new WebUser();
		$webUser->changeUser($Employee->id, $Employee->username, array('isMaskedUser' => true));

		$this->redirect('/');
	}
}
