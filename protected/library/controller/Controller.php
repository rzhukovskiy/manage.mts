<?php
class Controller extends CController
{
	public $layout='//layouts/main';

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'allow',
				'controllers' => array('home'),
				'users' => array('*'),
			),
			array(
				'allow',
				'controllers' => array('message', 'request', 'refused', 'requestEmployees', 'requestComments', 'requestDetails', 'archive'),
				'roles' => array(Employee::EMPLOYEE_ROLE),
			),
			array(
				'allow',
				'controllers' => array('employee', 'employeeGroup', 'report', 'admin'),
				'roles' => array(Employee::ADMIN_ROLE),
			),
			array(
				'deny',
				'users' => array('*'),
			),
		);
	}

	protected function outJson($data)
	{
		header('Content-type: application/json');
		echo CJSON::encode($data);

		foreach (Yii::app()->log->routes as $route) {
			if($route instanceof CWebLogRoute) {
				$route->enabled = false; // disable any weblogroutes
			}
		}
		Yii::app()->end();
	}
}
