<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 09.05.2016
 * Time: 7:37
 */
class Excel
{
    public static function companyListAutoFromExcelFile($requestId, $file)
    {
        $objPHPExcel = self::saveFromExternal($file);

        foreach($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();

            for($row = 1; $row <= $highestRow; ++$row) {
                $model = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $state_number = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                if (
                    PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($model) == PHPExcel_Cell_DataType::TYPE_STRING
                    && PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($type) == PHPExcel_Cell_DataType::TYPE_STRING
                    && PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($state_number) == PHPExcel_Cell_DataType::TYPE_STRING
                ) {
                    $RequestCompanyListAuto = new RequestCompanyListAuto();
                    $RequestCompanyListAuto->model = $model;
                    $RequestCompanyListAuto->request_ptr_id = $requestId;
                    $RequestCompanyListAuto->type = $type;
                    $RequestCompanyListAuto->state_number = $state_number;

                    $RequestCompanyListAuto->save();
                };
            }
        }

        return true;
    }

    public static function companyDriverFromExcelFile($requestId, $file)
    {
        $objPHPExcel = self::saveFromExternal($file);

        foreach($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();

            for($row = 1; $row <= $highestRow; ++$row) {
                $model = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $fio = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $phone = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                if (
                    PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($model) == PHPExcel_Cell_DataType::TYPE_STRING
                    && PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($type) == PHPExcel_Cell_DataType::TYPE_STRING
                    && PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($fio) == PHPExcel_Cell_DataType::TYPE_STRING
                ) {
                    $RequestCompanyDriver = new RequestCompanyDriver();
                    $RequestCompanyDriver->model = $model;
                    $RequestCompanyDriver->request_ptr_id = $requestId;
                    $RequestCompanyDriver->type = $type;
                    $RequestCompanyDriver->fio = $fio;
                    $RequestCompanyDriver->phone = $phone;

                    $RequestCompanyDriver->save();
                };
            }
        }

        return true;
    }

    private static function saveFromExternal($file)
    {
        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import("application.vendor.PHPExcel.Classes.PHPExcel", true);
        spl_autoload_register(array('YiiBase','autoload'));

        return PHPExcel_IOFactory::load($file['files']['tmp_name']);
    }
}
