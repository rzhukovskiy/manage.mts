<?php
$timeZone = new DateTimeZone(date_default_timezone_get());

$sql = "INSERT INTO mts_request (`name`, `new`,
`address_timezone`, `address_index`, `address_city`, `address_street`, `address_house`, `address_phone`,
`time_from`, `time_to`,
`director_name`, `director_email`, `director_phone`,
`doc_name`, `doc_email`, `doc_phone`)
VALUES (:name, '1',
:address_timezone, :address_index, :address_city, :address_street, :address_house, :address_phone,
:time_from, :time_to,
:director_name, :director_email, :director_phone,
:doc_name, :doc_email, :doc_phone)";
$res = $db->prepare($sql);

$param = array(
    ":name" => htmlspecialchars($info['name']),
    ":address_timezone" => $timeZone->getName(),
    ":address_index" => htmlspecialchars($info['index']),
    ":address_city" => htmlspecialchars($info['city']),
    ":address_street" => htmlspecialchars($info['street']),
    ":address_house" => htmlspecialchars($info['house']),
    ":address_phone" => htmlspecialchars($info['phone']),

    ":time_from" => htmlspecialchars($info['time-from']),
    ":time_to" => htmlspecialchars($info['time-to']),

    ":director_name" => htmlspecialchars($info['director-name']),
    ":director_email" => htmlspecialchars($info['director-email']),
    ":director_phone" => htmlspecialchars($info['director-phone']),

    ":doc_name" => htmlspecialchars($info['doc-name']),
    ":doc_email" => htmlspecialchars($info['doc-email']),
    ":doc_phone" => htmlspecialchars($info['doc-phone'])
);

$res->execute($param);

$requestId = $db->lastInsertId();

$sql = "INSERT INTO mts_request_process
(`request_id`, `employee_group_id`, `done`) VALUES (:request_id, :employee_group_id, :done)";
$res = $db->prepare($sql);

$param = array(
    ":request_id" => $requestId,
    ":employee_group_id" => 0,
    ":done" => 0
);

$res->execute($param);

if (htmlspecialchars($info['director-name']) || htmlspecialchars($info['director-email']) || htmlspecialchars($info['director-phone'])) {
    $sql = "INSERT INTO mts_request_employee (`request_id`, `position`, `name`, `phone`, `email`)
VALUES (:request_id, :position, :name, :phone, :email)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_id" => $requestId,
        ":position" => htmlspecialchars($info['director-position']),
        ":name" => htmlspecialchars($info['director-name']),
        ":phone" => htmlspecialchars($info['director-email']),
        ":email" => htmlspecialchars($info['director-phone'])
    );

    $res->execute($param);
}

if (htmlspecialchars($info['doc-name']) || htmlspecialchars($info['doc-email']) || htmlspecialchars($info['doc-phone'])) {
    $sql = "INSERT INTO mts_request_employee (`request_id`, `position`, `name`, `phone`, `email`)
VALUES (:request_id, :position, :name, :phone, :email)";
    $res = $db->prepare($sql);

    $param = array(
        ":request_id" => $requestId,
        ":position" => htmlspecialchars($info['doc-position']),
        ":name" => htmlspecialchars($info['doc-name']),
        ":phone" => htmlspecialchars($info['doc-email']),
        ":email" => htmlspecialchars($info['doc-phone'])
    );

    $res->execute($param);
}
