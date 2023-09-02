<?php

function handleNotFound() {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
    exit;
}

function getControllerFilePath($controller, $method) {
    return __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $method . '.php';
}

$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

$base_path = dirname($script_name);

if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
} else {
    handleNotFound();
}

if (($pos = strpos($request_uri, '?')) !== false) {
    $request_uri = substr($request_uri, 0, $pos);
}

$segments = explode('/', trim($request_uri, '/'));

if (count($segments) < 2) {
    handleNotFound();
}

$controller = $segments[0];
$method = $segments[1];

$script_path = getControllerFilePath($controller, $method);

if (file_exists($script_path)) {
    require_once $script_path;
} else {
    handleNotFound();
}
