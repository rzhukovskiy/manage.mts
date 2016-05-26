<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.05.2016
 * Time: 16:39
 */
class RequestWashInstance extends Instance
{
    public function __construct($Model)
    {
        parent::__construct($Model);
    }

    /**
     * @param array $post
     * @return bool
     * @throws Exception
     */
    public function update($post)
    {
        if (isset($post['RequestWashServeOrganisation'])) {
            for ($i = 0; $i < count($post['RequestWashServeOrganisation']['name']); $i++) {
                $RequestWashServeOrganisation = new RequestWashServeOrganisation();
                $RequestWashServeOrganisation->request_ptr_id = $this->Model->request_ptr_id;
                $RequestWashServeOrganisation->name = $post['RequestWashServeOrganisation']['name'][$i];
                $RequestWashServeOrganisation->phone = $post['RequestWashServeOrganisation']['phone'][$i];
                if (!$RequestWashServeOrganisation->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestWashServeOrganisation));
                }
            }
        }

        return true;
    }

    /**
     * @param $post
     * @return bool
     * @throws Exception
     */
    public function updateWashPrices($post)
    {
        RequestWashService::model()->deleteAll(array(
            "condition" => 'request_ptr_id = :request_ptr_id',
            'params' => [':request_ptr_id' => $this->Model->request_ptr_id]
        ));
        if (isset($post['RequestWashService'])) {
            for ($i = 0; $i < count($post['RequestWashService']['type']); $i++) {
                $RequestWashService = new RequestWashService();
                $RequestWashService->request_ptr_id = $this->Model->request_ptr_id;
                $RequestWashService->type = $post['RequestWashService']['type'][$i];
                $RequestWashService->price_outside = $post['RequestWashService']['price_outside'][$i];
                $RequestWashService->price_inside = $post['RequestWashService']['price_inside'][$i];
                if (!$RequestWashService->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestWashService));
                }
            }
        }

        return true;
    }

    public function deleteFromArchive()
    {
        $RequestWashServeOrganisation = RequestWashServeOrganisation::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestWashServeOrganisation !== null) {
            $RequestWashServeOrganisation->delete();
        }

        $RequestWashService = RequestWashService::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestWashService !== null) {
            $RequestWashService->delete();
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
