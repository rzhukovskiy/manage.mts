<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.05.2016
 * Time: 15:24
 */
abstract class Instance
{
    /** @var RequestCompany|RequestService|RequestTires|RequestWash */
    protected $Model;

    /**
     * Create request to archive
     * @return int ID of new request
     * @throws Exception
     */
    public function createToArchive()
    {
        /** @var Request $Request */
        $Request = new Request();
        $Request->state = Request::STATE_DONE;
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        $this->Model->request_ptr_id = $Request->id;
        if (!$this->Model->save()) {
            $Request->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        return $Request->id;
    }

    /**
     * Create request to refused
     * @return int ID of new request
     * @throws Exception
     */
    public function createToRefused()
    {
        /** @var Request $Request */
        $Request = new Request();
        $Request->state = Request::STATE_REFUSED;
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        $this->Model->request_ptr_id = $Request->id;
        if (!$this->Model->save()) {
            $Request->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        return $Request->id;
    }

    /**
     * Create request to process
     * @param $Employee Employee
     * @return int ID of new request
     * @throws Exception
     */
    public function createToProcess($Employee)
    {
        /** @var Request $Request */
        $Request = new Request();
        $Request->state = Request::STATE_PROCESS;
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        $this->Model->request_ptr_id = $Request->id;
        if (!$this->Model->save()) {
            $Request->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        $RequestProcessEmployee = new RequestProcessEmployee();
        $RequestProcessEmployee->request_id = $Request->id;
        $RequestProcessEmployee->created = date('Y-m-d');
        $RequestProcessEmployee->employee_id = $Employee->id;

        if (!$RequestProcessEmployee->save()) {
            $Request->delete();
            $this->Model->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        return $Request->id;
    }

    /**
     * @param array $post
     * @return bool
     */
    abstract public function update($post);

    public function __construct($Model)
    {
        $this->Model = $Model;
    }

    public static function init($id)
    {
        $Model = self::detectType($id);
        if (!$Model) {
            throw new \Exception('?????? ???????????? ???? ??????????????????');
        }

        switch($Model::REQUEST_TYPE) {
            case RequestCompany::REQUEST_TYPE:
                $Instance = new RequestCompanyInstance($Model);
                break;
            case RequestService::REQUEST_TYPE:
                $Instance = new RequestServiceInstance($Model);
                break;
            case RequestTires::REQUEST_TYPE:
                $Instance = new RequestTiresInstance($Model);
                break;
            case RequestWash::REQUEST_TYPE:
                $Instance = new RequestWashInstance($Model);
                break;
            default:
                $Instance = false;
        }

        return $Instance;
    }

    /**
     * @param integer $id
     * @return bool|RequestCompany|RequestService|RequestTires|RequestWash false if type not detected
     */
    public static function detectType($id)
    {
        /** @var RequestCompany $Model */
        $Model = RequestCompany::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $id)
        );
        if ($Model !== null) {
            return $Model;
        }

        /** @var RequestService $Model */
        $Model = RequestService::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $id)
        );
        if ($Model !== null) {
            return $Model;
        }

        /** @var RequestTires $Model */
        $Model = RequestTires::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $id)
        );
        if ($Model !== null) {
            return $Model;
        }

        /** @var RequestWash $Model */
        $Model = RequestWash::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $id)
        );
        if ($Model !== null) {
            return $Model;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getType()
    {
        $Model = $this->Model;

        return $Model::REQUEST_TYPE;
    }

    /**
     * @return RequestCompany|RequestService|RequestTires|RequestWash
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * @param integer $id PK
     * @param string $name table key
     * @param string $value table value
     * @return bool true
     * @throws Exception
     */
    public function updateAjax($id, $name, $value)
    {
        $Request = Request::model()->findByPk($id);
        $Request->$name = $value;
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        return true;
    }

    /**
     * @param $filename
     * @return bool true
     * @throws Exception
     */
    public function updateAgreementFile($filename)
    {
        /** @var Request $Request */
        $Request = Request::model()->findByPk($this->Model->request_ptr_id);
        $Request->agreement_file = $filename;
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        return true;
    }

    /**
     * @return string Filename
     */
    public function getAgreementFile()
    {
        $Request = Request::model()->findByPk($this->Model->request_ptr_id);

        return $Request->agreement_file;
    }
}
