<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 02.04.2016
 * Time: 13:26
 */

$sql = "INSERT INTO mts_request_wash (`request_ptr_id`) VALUES (:request_ptr_id)";
$res = $db->prepare($sql);

$param = array(
    ":request_ptr_id" => $requestId
);

$res->execute($param);

for($i = 1; $i < count($request['name']); $i++) {
    $sql = "INSERT INTO mts_request_wash_serve_organisation (`request_ptr_id`, `name`, `phone`) VALUES (:request_ptr_id, :name, :phone)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":name" => htmlspecialchars($request['name'][$i]),
        ":phone" => htmlspecialchars($request['phone'][$i])
    );

    $res->execute($param);
}
