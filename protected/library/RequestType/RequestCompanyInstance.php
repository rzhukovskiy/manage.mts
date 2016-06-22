<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 03.05.2016
 * Time: 16:39
 */
class RequestCompanyInstance extends Instance
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
        if (isset($post['RequestPrice'])) {
            for ($i = 0; $i < count($post['RequestPrice']['model']); $i++) {
                $RequestPrice = new RequestPrice();
                $RequestPrice->request_ptr_id = $this->Model->request_ptr_id;
                $RequestPrice->type = $post['RequestPrice']['type'][$i];
                $RequestPrice->price_outside = $post['RequestPrice']['price_outside'][$i];
                $RequestPrice->price_inside = $post['RequestPrice']['price_inside'][$i];
                if (!$RequestPrice->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestPrice));
                }
            }
        }

        if (isset($post['RequestCompanyListAuto'])) {
            for ($i = 0; $i < count($post['RequestCompanyListAuto']['model']); $i++) {
                $RequestCompanyListAuto = new RequestCompanyListAuto();
                $RequestCompanyListAuto->request_ptr_id = $this->Model->request_ptr_id;
                $RequestCompanyListAuto->model = $post['RequestCompanyListAuto']['model'][$i];
                $RequestCompanyListAuto->type = $post['RequestCompanyListAuto']['type'][$i];
                $RequestCompanyListAuto->state_number = $post['RequestCompanyListAuto']['state_number'][$i];
                if (!$RequestCompanyListAuto->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestCompanyListAuto));
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
    public function updateCompanyDrivers($post)
    {
        if (isset($post['RequestCompanyDriver'])) {
            for ($i = 0; $i < count($post['RequestCompanyDriver']['fio']); $i++) {
                $RequestCompanyDriver = new RequestCompanyDriver();
                $RequestCompanyDriver->request_ptr_id = $this->Model->request_ptr_id;
                $RequestCompanyDriver->model = $post['RequestCompanyDriver']['model'][$i];
                $RequestCompanyDriver->type = $post['RequestCompanyDriver']['type'][$i];
                $RequestCompanyDriver->fio = $post['RequestCompanyDriver']['fio'][$i];
                $RequestCompanyDriver->phone = $post['RequestCompanyDriver']['phone'][$i];

                if (!$RequestCompanyDriver->save()) {
                    throw new \Exception(CHtml::errorSummary($RequestCompanyDriver));
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
    public function updateCompanyContact($name, $value)
    {
        $RequestCompany = RequestCompany::model()->findByPk($this->Model->request_ptr_id);
        $RequestCompany->$name = $value;
        if (!$RequestCompany->save()) {
            throw new \Exception(CHtml::errorSummary($RequestCompany));
        }

        return true;
    }

    public function deleteFromArchive()
    {
        $RequestCompanyListAuto = RequestCompanyListAuto::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestCompanyListAuto !== null) {
            $RequestCompanyListAuto->delete();
        }

        $RequestCompanyDriver = RequestCompanyDriver::model()->find(
            "request_ptr_id = :request_ptr_id",
            array("request_ptr_id" => $this->Model->request_ptr_id)
        );
        if ($RequestCompanyDriver !== null) {
            $RequestCompanyDriver->delete();
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
