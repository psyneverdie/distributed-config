<?php

require 'connect.php';
require 'functions.php';
header('Content-Type: application/json; charset=utf-8');

$q = $_GET['q'];
//Получение значений URL
$method = $_SERVER['REQUEST_METHOD'];
$params = explode('/', $q);
$type = $params[0];
$serviceName = $params[1];
$id = $params[2];


if ($method === 'GET') {
    if ($type === 'service') {
        if (isset($id)) {
            getServiceData($connect, $id);
        } elseif (isset($serviceName)) {
            getService($connect, $serviceName);
        } else {
            getServices($connect);
        }
    }
} elseif ($method === 'POST') {
    if ($type === 'service') {
        if (isset($serviceName)) {
            addServiceData($connect, $_POST, $id, $serviceName);
        }
    }
} elseif ($method === 'PATCH') {
    if ($type === 'service') {
        if(isset($id)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            updateServiceData($connect, $id, $data);
        } elseif (isset($serviceName)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            updateServiceName($connect, $serviceName, $data);
        }
    }
} elseif ($method === 'DELETE') {
    if ($type === 'service') {
        if(isset($id)) {
            deleteServiceData($connect, $id);
        }elseif (isset($serviceName)){
            deleteService($connect, $serviceName);
        }
    }
}