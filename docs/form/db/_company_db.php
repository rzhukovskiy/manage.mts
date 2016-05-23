<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 27.04.2016
 * Time: 18:26
 */

$sql = "INSERT INTO mts_request_company
(`request_ptr_id`, `contact_name`, `phone`, `email`) VALUES (:request_id, :contact_name, :phone, :email)";
$res = $db->prepare($sql);

$param = array(
    ":request_id" => $requestId,
    ":contact_name" => $info['contact_name'],
    ":phone" => $info['phone'],
    ":email" => $info['email']
);

$res->execute($param);

$cities = explode(",", $info['city']);
for($i = 1; $i < count($cities); $i++) {
    $sql = "INSERT INTO mts_request_company_city
(`request_ptr_id`, `city`) VALUES (:request_ptr_id, :city)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":city" => htmlspecialchars(trim($cities[$i]))
    );

    $res->execute($param);
}

for($i = 1; $i < count($request['model']); $i++) {
    $sql = "INSERT INTO mts_request_company_autopark
(`request_ptr_id`, `model`, `type`, `amount`, `price_outside`, `price_inside`)
VALUES
(:request_ptr_id, :model, :type, :amount, :price_outside, :price_inside)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_ptr_id" => $requestId,
        ":model" => htmlspecialchars($request['model'][$i]),
        ":type" => htmlspecialchars($request['type'][$i]),
        ":amount" => htmlspecialchars($request['amount'][$i]),
        ":price_outside" => htmlspecialchars($request['price_outside'][$i]),
        ":price_inside" => htmlspecialchars($request['price_inside'][$i])
    );

    $res->execute($param);
}
