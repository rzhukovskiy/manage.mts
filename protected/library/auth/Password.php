<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 10.04.2016
 * Time: 11:36
 */

/**
 * Class Password
 */
class Password
{
    private $password;
    private $salt;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param int $length
     * @return string
     */
    public function randomSalt($length = 5)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime() * 1000000);
        $i = 1;
        $salt = '';

        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $salt .= $tmp;
            $i++;
        }
        return $salt;
    }

    /**
     * Generate salt and hash password with new salt
     *
     * @return bool true
     */
    public function beforeSave()
    {
        $salt = self::randomSalt();
        $this->setSalt($salt);
        $this->password = self::hashPassword();

        return true;
    }

    /**
     * Return hash password
     *
     * @return string
     */
    public function hashPassword()
    {
        return md5($this->salt . $this->password);
    }
}
