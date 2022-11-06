<?php

function getServiceData($connect, $id){
    $sql = "SELECT * FROM `sberconfig` WHERE `id` = :id";
    $service = $connect->prepare($sql);
    $service->execute(['id' => $id]);
// Проверка на наличие поста
    $sql = "SELECT COUNT(*) FROM `sberconfig` WHERE `id` = :id";
    $res = $connect->prepare($sql);
    $res->execute(['id' => $id]);
    $count = $res->fetchColumn();
    if ($count == '0') {
        http_response_code(404);
        $answer = [
            "status" => false,
            "message" => "Service data not found"
        ];
        echo json_encode($answer);
    } else {
        $service = $service->fetch(PDO::FETCH_ASSOC);
        $arrayCount = count($service);
        $new_arr = [];
        var_dump($arrayCount);
            $arrayConstruct = [
                $service['keyname'] => $service['value']
            ];
            foreach ($arrayConstruct AS $key => $val) {
                $new_arr[$key] = $val;
            }
        echo json_encode($new_arr);
    }
}

function getService($connect, $serviceName){
    $sql = "SELECT * FROM `sberconfig` WHERE `service` = :service";
    $service = $connect->prepare($sql);
    $service->execute(['service' => $serviceName]);
// Проверка на наличие поста
    $sql = "SELECT COUNT(*) FROM `sberconfig` WHERE `service` = :service";
    $res = $connect->prepare($sql);
    $res->execute(['service' => $serviceName]);
    $count = $res->fetchColumn();
    if ($count == '0') {
        http_response_code(404);
        $answer = [
            "status" => false,
            "message" => "Service not found"
        ];
        echo json_encode($answer);
    } else {
        $service = $service->fetchAll(PDO::FETCH_ASSOC);
        $arrayCount = count($service);
        $new_arr = [];
        for ($i = 0; $i < $arrayCount; $i++) {
            $arrayConstruct[$i] = [
                $service[$i]['keyname'] => $service[$i]['value']
            ];
            foreach ($arrayConstruct[$i] AS $key => $val) {
                $new_arr[$key] = $val;
            }
        }
        echo json_encode($new_arr);
    }
}

function getServices($connect){
        $sql = "SELECT * FROM `sberconfig`";
        $service = $connect->prepare($sql);
        $service->execute();
        $serviceList = [];
        while ($get = $service->fetch(PDO::FETCH_ASSOC)) {
            $serviceList[] = $get;
        }
        echo json_encode($serviceList);
}

function addServiceData($connect, $data, $id, $serviceName) {
    $sql = "INSERT INTO sberconfig VALUES (NULL, :service, :keyname, :value)";
    $res = $connect->prepare($sql);
    $res->bindParam(':service', $serviceName);
    $res->bindParam(':keyname', $data['key']);
    $res->bindParam(':value', $data['value']);
    $res->execute();

    http_response_code(201);

    $answer = [
        "status" => true,
        "message" => "Service data is created"
    ];
    echo json_encode($answer);
}

function updateServiceData($connect, $id, $data) {
    $key = $data['key'];
    $value = $data['value'];
    $sql = "UPDATE sberconfig SET keyname = :key, value = :value WHERE id = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":key", $key);
    $stmt->bindValue(":value", $value);
    $stmt->execute();

    http_response_code(200);

    $answer = [
        "status" => true,
        "message" => "Service data is updated"
    ];
    echo json_encode($answer);
}

function updateServiceName($connect, $serviceName, $data) {
    $newServiceName = $data['service'];
    $sql = "UPDATE sberconfig SET service = :newservicename WHERE service = :servicename";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":newservicename", $newServiceName);
    $stmt->bindValue(":servicename", $serviceName);
    $stmt->execute();

    http_response_code(200);

    $answer = [
        "status" => true,
        "message" => "Service name is updated"
    ];
    echo json_encode($answer);
}

function deleteServiceData ($connect, $id) {
    $sql = "DELETE FROM sberconfig WHERE id = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    http_response_code(200);

    $answer = [
        "status" => true,
        "message" => "Service data is deleted"
    ];
    echo json_encode($answer);
}

function deleteService ($connect, $serviceName) {
    $sql = "DELETE FROM sberconfig WHERE service = :service";
    $stmt = $connect->prepare($sql);
    $stmt->bindValue(":service", $serviceName);
    $stmt->execute();

    http_response_code(200);

    $answer = [
        "status" => true,
        "message" => "Service is deleted"
    ];
    echo json_encode($answer);
}