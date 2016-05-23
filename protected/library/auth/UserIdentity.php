<?php

class UserIdentity extends CUserIdentity
{
    const ERROR_USER_BLOCKED = 3;

    private $_id;

    public function authenticate()
    {
        $Employee = Employee::model()->find('LOWER(username)=?', array(strtolower($this->username)));

        if ($Employee === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!$Employee->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $Employee->id;
            $this->username = $Employee->username;
            $this->errorCode = self::ERROR_NONE;
        }

        if (Yii::app()->user->checkAccess(Employee::ADMIN_ROLE)) {
            $this->_id = $Employee->id;

            return $this->errorCode == self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function adminAuthenticate(Employee $Employee)
    {
        $this->_id = $Employee->id;
        $this->username = $Employee->username;
        $this->errorCode = self::ERROR_NONE;

        return true;
    }
}