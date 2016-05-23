<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 02.04.2016
 * Time: 18:33
 */

$sql = "INSERT INTO mts_request_tires (`request_ptr_id`,
`service_mounting`, `service_tires_sale`, `service_disk_sale`,
`serve_car`, `serve_truck`, `serve_tech`,
`sale_for_car`, `sale_for_truck`, `sale_for_tech`)
VALUES (:request_ptr_id,
:service_mounting, :service_tires_sale, :service_disk_sale,
:serve_car, :serve_truck, :serve_tech,
:sale_for_car, :sale_for_truck, :sale_for_tech)";
$res = $db->prepare($sql);

isset($info['tire']) ? $tire = 1 : $tire = 0;
isset($info['sell-tires']) ? $sellTires = 1 : $sellTires = 0;
isset($info['sell-discs']) ? $sellDiscs = 1 : $sellDiscs = 0;
isset($info['tires-car']) ? $tiresCar = 1 : $tiresCar = 0;
isset($info['tires-truck']) ? $tiresTruck = 1 : $tiresTruck = 0;
isset($info['tires-tech']) ? $tiresTech = 1 : $tiresTech = 0;
isset($info['disc-car']) ? $discCar = 1 : $discCar = 0;
isset($info['disc-truck']) ? $discTruck = 1 : $discTruck = 0;
isset($info['disc-tech']) ? $discTech = 1 : $discTech = 0;

$param = array(
    ":request_ptr_id" => $requestId,
    ":service_mounting" => $tire,
    ":service_tires_sale" => $sellTires,
    ":service_disk_sale" => $sellDiscs,
    ":serve_car" => $tiresCar,
    ":serve_truck" => $tiresTruck,
    ":serve_tech" => $tiresTech,
    ":sale_for_car" => $discCar,
    ":sale_for_truck" => $discTruck,
    ":sale_for_tech" => $discTech
);

$res->execute($param);

for($i = 1; $i < count($request['name']); $i++) {
    $sql = "INSERT INTO mts_request_tires_serve_organisation (`request_ptr_id`, `name`, `phone`) VALUES (:request_ptr_id, :name, :phone)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":name" => htmlspecialchars($request['name'][$i]),
        ":phone" => htmlspecialchars($request['phone'][$i])
    );

    $res->execute($param);
}
