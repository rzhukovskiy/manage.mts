<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.05.2016
 * Time: 16:39
 */
class RequestTiresInstance extends Instance
{
    public function __construct($Model)
    {
        parent::__construct($Model);
    }

    public function update($post)
    {

        $this->Model->attributes = $this->compParams($post["RequestTires"]);
        if (!$this->Model->save()) {
            throw new \Exception(CHtml::errorSummary($this->Model));
        }

        RequestTiresServeOrganisation::model()->deleteAll(array(
            "condition" => 'request_ptr_id = :request_ptr_id',
            'params' => [':request_ptr_id' => $this->Model->request_ptr_id]
        ));

        if (isset($post['RequestTiresServeOrganisation'])) {
            for ($i = 0; $i < count($post['RequestTiresServeOrganisation']['name']); $i++) {
                $RequestTiresServeOrganisation = new RequestTiresServeOrganisation();
                $RequestTiresServeOrganisation->request_ptr_id = $this->Model->request_ptr_id;
                $RequestTiresServeOrganisation->name = $post['RequestTiresServeOrganisation']['name'][$i];
                $RequestTiresServeOrganisation->phone = $post['RequestTiresServeOrganisation']['phone'][$i];
                if (!$RequestTiresServeOrganisation->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestTiresServeOrganisation));
                }
            }
        }

        return true;
    }

    /**
     * Заполнить массив недостающими параметрами
     * Примечание: в массиве $_POST нет значений для невыбранных checkboxes
     *
     * @param array $array input array
     * @return array output array
     */
    private function compParams($array)
    {
        foreach($this->Model->attributes as $currentAttribute=>$currentAttributeValue) {
            if ($currentAttribute === 'request_ptr_id') {
                continue;
            }

            if (!array_key_exists($currentAttribute, $array)) {
                $array[$currentAttribute] = 0;
            }
        }

        return $array;
    }

    public function deleteFromArchive()
    {
        $RequestTiresServeOrganisation = RequestTiresServeOrganisation::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestTiresServeOrganisation !== null) {
            $RequestTiresServeOrganisation->delete();
        }

        $this->Model->delete();

        Request::model()->deleteByPk($this->Model->request_ptr_id);

        return true;
    }
}
