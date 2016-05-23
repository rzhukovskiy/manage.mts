<?php

class EmployeeGroupController extends Controller
{
	/** @var $Employee Employee */
	private $Employee;

	public function init()
	{
		$userId = Yii::app()->user->id;

		$this->Employee = Employee::model()->findByPk($userId);
	}

	/**
	 * Main action
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;

		$sort = new CSort();

		$DataProvider = new CActiveDataProvider(EmployeeGroup::model(), array(
			'criteria' => $criteria,
			'sort' => $sort
		));

		$EmployeeGroups = EmployeeGroup::model()->findAll(array("order" => "id"));

		$grid = $this->renderPartial('_grid', array(
			'DataProvider' => $DataProvider
		), true);

		$this->render('index',array(
			'grid' => $grid,
			'EmployeeGroups' => $EmployeeGroups,
			'numEmployeeGroups' => count($EmployeeGroups)
		));
	}

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$EmployeeGroupLib = new EmployeeGroupLib($this->Employee);

		try {
			$postEmployeeGroup = [];
			if (isset($_POST["EmployeeGroup"])) {
				$postEmployeeGroup = $_POST["EmployeeGroup"];
			}
			$postEmployeeGroupType = [];
			if (isset($_POST["EmployeeGroupType"])) {
				$postEmployeeGroupType = $_POST["EmployeeGroupType"];
			}
			$postEmployeeGroupArchive = [];
			if (isset($_POST["EmployeeGroupArchive"])) {
				$postEmployeeGroupArchive = $_POST["EmployeeGroupArchive"];
			}

			$EmployeeGroup = $EmployeeGroupLib->create($postEmployeeGroup, $postEmployeeGroupType, $postEmployeeGroupArchive);
		} catch(\Exception $e) {
			Yii::app()->user->setFlash('error', $e->getMessage());
		}

		$this->redirect(array('index'));
	}

	/**
	 * Updates a particular model.
	 *
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$EmployeeGroupLib = new EmployeeGroupLib($this->Employee);

		$EmployeeGroup = $EmployeeGroupLib->loadModel($id);

		if(isset($_POST['EmployeeGroup'])) {
			try {
				$postEmployeeGroup = [];
				if (isset($_POST["EmployeeGroup"])) {
					$postEmployeeGroup = $_POST["EmployeeGroup"];
				}
				$postEmployeeGroupType = [];
				if (isset($_POST["EmployeeGroupType"])) {
					$postEmployeeGroupType = $_POST["EmployeeGroupType"];
				}
				$postEmployeeGroupArchive = [];
				if (isset($_POST["EmployeeGroupArchive"])) {
					$postEmployeeGroupArchive = $_POST["EmployeeGroupArchive"];
				}

				$EmployeeGroupAfterUpdate
					= $EmployeeGroupLib->update($id, $postEmployeeGroup, $postEmployeeGroupType, $postEmployeeGroupArchive);
			} catch (\Exception $e) {
				Yii::app()->user->setFlash('error', $e->getMessage());
			}

			$this->redirect(array('index'));
		}

		$EmployeeGroupAll = EmployeeGroup::model()->findAll(array(
			"condition" => "id != :employee_group_id",
			"params" => array("employee_group_id" => $id)
		));

		$this->render('update',array(
			'model' => $EmployeeGroup,
			'EmployeeGroup' => $EmployeeGroupAll,
			'numEmployeeGroups' => count($EmployeeGroupAll)
		));
	}

	/**
	 * Deletes a particular model.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$EmployeeGroupLib = new EmployeeGroupLib($this->Employee);
		$EmployeeGroupLib->delete($id);

		EmployeeGroupsOrderNumber::reCalcOrderNumbers();

		$this->redirect(array('index'));
	}
}
