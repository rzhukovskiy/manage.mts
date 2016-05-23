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
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        $this->Model->request_ptr_id = $Request->id;
        if (!$this->Model->save()) {
            $Request->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        $RequestDone = new RequestDone();
        $RequestDone->request_id = $Request->id;
        if (!$RequestDone->save()) {
            $Request->delete();
            $this->Model->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        return $Request->id;
    }

    /**
     * Create request to archive
     * @param $Employee Employee
     * @return int ID of new request
     * @throws Exception
     */
    public function createToProcess($Employee)
    {
        /** @var Request $Request */
        $Request = new Request();
        if (!$Request->save()) {
            throw new \Exception(CHtml::errorSummary($Request));
        }

        $this->Model->request_ptr_id = $Request->id;
        if (!$this->Model->save()) {
            $Request->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        $RequestProcess = new RequestProcess();
        $RequestProcess->request_id = $Request->id;
        $RequestProcess->updated = date('Y-m-d');
        $RequestProcess->employee_group_id = $Employee->employee_group_id;

        if (!$RequestProcess->save()) {
            $Request->delete();
            $this->Model->delete();

            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        $RequestProcessEmployee = new RequestProcessEmployee();
        $RequestProcessEmployee->request_process_id = $RequestProcess->id;
        $RequestProcessEmployee->created = date('Y-m-d');
        $RequestProcessEmployee->employee_id = $Employee->id;

        if (!$RequestProcessEmployee->save()) {
            $Request->delete();
            $RequestProcess->delete();
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
            throw new \Exception('Тип заявки не определен');
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
