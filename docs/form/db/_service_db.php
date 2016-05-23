<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 02.04.2016
 * Time: 18:33
 */

$sql = "INSERT INTO mts_request_service (`request_ptr_id`, `official_dealer`, `nonofficial_dealer`)
VALUES (:request_ptr_id, :official_dealer, :nonofficial_dealer)";
$res = $db->prepare($sql);

$param = array(
    ":request_ptr_id" => $requestId,
    ":official_dealer" => htmlspecialchars($info['official']),
    ":nonofficial_dealer" => htmlspecialchars($info['nonofficial'])
);

$res->execute($param);

for($i = 1; $i < count($request['name']); $i++) {
    $sql = "INSERT INTO mts_request_service_serve_organisation (`request_ptr_id`, `name`, `phone`) VALUES (:request_ptr_id, :name, :phone)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":name" => htmlspecialchars($request['name'][$i]),
        ":phone" => htmlspecialchars($request['phone'][$i])
    );

    $res->execute($param);
}

for($i = 1; $i < count($work['type']); $i++) {
    $sql = "INSERT INTO mts_request_service_work_rate (`request_ptr_id`, `work_name`, `rate`) VALUES (:request_ptr_id, :work_name, :rate)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":work_name" => htmlspecialchars($work['type'][$i]),
        ":rate" => htmlspecialchars($work['norm'][$i])
    );

    $res->execute($param);
}
