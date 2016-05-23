<?php
class WebUser extends CWebUser
{
    private $role = null;
    private $model = null;

    function getRole()
    {
        if ($Employee = $this->getModel()) {
            return $Employee->role;
        }
    }

    function getUsername()
    {
        if ($Employee = $this->getModel()) {
            return $Employee->username;
        }
    }

    public function getModel()
    {
        if (!$this->isGuest && $this->model === null) {
            $this->model = Employee::model()->findByPk($this->id);
        }
        return $this->model;
    }

    public function changeUser($id, $username, $array)
    {
        return $this->changeIdentity($id, $username, $array);
    }
}
