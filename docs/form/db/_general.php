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
(`request_id`, `employee_group_id`, `processing`, `done`) VALUES (:request_id, :employee_group_id, :processing, :done)";
$res = $db->prepare($sql);

$param = array(
    ":request_id" => $requestId,
    ":employee_group_id" => 0,
    ":processing" => 0,
    ":done" => 0
);

$res->execute($param);
