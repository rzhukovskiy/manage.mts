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

    public function deleteFromArchive()
    {
        $RequestWashServeOrganisation = RequestWashServeOrganisation::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestWashServeOrganisation !== null) {
            $RequestWashServeOrganisation->delete();
        }

        $RequestWashService = RequestPrice::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestWashService !== null) {
            $RequestWashService->delete();
        }

        $this->Model->delete();

        Request::model()->deleteByPk($this->Model->request_ptr_id);

        return true;
    }
}
