<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.05.2016
 * Time: 16:39
 */
class RequestServiceInstance extends Instance
{
    public function __construct($Model)
    {
        parent::__construct($Model);
    }

    public function update($post)
    {
        RequestServiceServeOrganisation::model()->deleteAll(array(
            "condition" => 'request_ptr_id = :request_ptr_id',
            'params' => [':request_ptr_id' => $this->Model->request_ptr_id]
        ));
        if (isset($post['RequestServiceServeOrganisation'])) {
            for ($i = 0; $i < count($post['RequestServiceServeOrganisation']['name']); $i++) {
                $RequestServiceServeOrganisation = new RequestServiceServeOrganisation();
                $RequestServiceServeOrganisation->request_ptr_id = $this->Model->request_ptr_id;
                $RequestServiceServeOrganisation->name = $post['RequestServiceServeOrganisation']['name'][$i];
                $RequestServiceServeOrganisation->phone = $post['RequestServiceServeOrganisation']['phone'][$i];
                if (!$RequestServiceServeOrganisation->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestServiceServeOrganisation));
                }
            }
        }

        RequestServiceWorkRate::model()->deleteAll(array(
            "condition" => 'request_ptr_id = :request_ptr_id',
            'params' => [':request_ptr_id' => $this->Model->request_ptr_id]
        ));
        if (isset($post['RequestServiceWorkRate'])) {
            for ($i = 0; $i < count($post['RequestServiceWorkRate']['type']); $i++) {
                $RequestServiceWorkRate = new RequestServiceWorkRate();
                $RequestServiceWorkRate->request_ptr_id = $this->Model->request_ptr_id;
                $RequestServiceWorkRate->work_name = $post['RequestServiceWorkRate']['type'][$i];
                $RequestServiceWorkRate->rate = $post['RequestServiceWorkRate']['norm'][$i];
                if (!$RequestServiceWorkRate->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestServiceWorkRate));
                }
            }
        }

        return true;
    }

    /**
     * @param string $name table key
     * @param string $value table value
     * @return bool
     * @throws Exception
     */
    public function updateServiceDealer($name, $value)
    {
        $RequestService = RequestService::model()->findByPk($this->Model->request_ptr_id);
        $RequestService->$name = $value;
        if (!$RequestService->save()) {
            throw new \Exception(CHtml::errorSummary($RequestService));
        }

        return true;
    }


    public function deleteFromArchive()
    {
        $RequestServiceWorkRate = RequestServiceWorkRate::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestServiceWorkRate !== null) {
            $RequestServiceWorkRate->delete();
        }

        $RequestServiceServeOrganisation = RequestServiceServeOrganisation::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestServiceServeOrganisation != null) {
            $RequestServiceServeOrganisation->delete();
        }

        $Request = RequestDone::model()->find(
            "request_id = :request_id",
            array("request_id" => $this->Model->request_ptr_id)
        );
        if ($Request !== null) {
            $Request->delete();
        }

        $Request = RequestProcess::model()->find(
            "request_id = :request_id",
            array("request_id" => $this->Model->request_ptr_id)
        );
        if ($Request !== null) {
            $Request->delete();
        }

        $this->Model->delete();

        Request::model()->deleteByPk($this->Model->request_ptr_id);

        return true;
    }
}
